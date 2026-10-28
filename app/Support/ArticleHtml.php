<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Illuminate\Support\Str;

/**
 * Cleans HTML that editors paste into the panel (blogs, tags, author topics)
 * so it always renders inside the site's article design.
 *
 * The pasted content may be a whole HTML page (doctype, <head>, <style>,
 * its own header/footer) or just a few <p> tags. Either way only the body
 * content is kept, inline styles and foreign classes are removed (only the
 * ij-* article classes survive), headings are normalised and h2s get ids
 * for the "On this page" list.
 */
class ArticleHtml
{
    /** Elements removed together with everything inside them. */
    private const DROP = [
        'head', 'title', 'meta', 'link', 'base', 'style', 'script', 'noscript', 'template',
        'header', 'footer', 'nav', 'form', 'input', 'button', 'select', 'textarea', 'label',
        'object', 'embed', 'applet', 'canvas', 'svg', 'math', 'dialog', 'frameset', 'frame',
    ];

    /** Elements replaced by their children (kept content, lost wrapper). */
    private const UNWRAP = ['html', 'body', 'main', 'font', 'center', 'span', 'o:p'];

    /** Attributes kept on any element. Everything else (style, on*, data-*, ids) is removed. */
    private const ATTRS = ['href', 'src', 'alt', 'title', 'colspan', 'rowspan', 'scope', 'start', 'reversed', 'open', 'datetime', 'cite', 'width', 'height', 'loading'];

    /** Iframes are kept only for these video hosts. */
    private const IFRAME_HOSTS = ['www.youtube.com', 'youtube.com', 'www.youtube-nocookie.com', 'player.vimeo.com'];

    /**
     * @return array{html: string, toc: array<int, array{id: string, text: string}>, text: string}
     */
    public static function render(?string $raw, ?string $pageTitle = null): array
    {
        $raw = trim((string) $raw);
        if ($raw === '') {
            return ['html' => '', 'toc' => [], 'text' => ''];
        }

        // A whole page: keep only what is inside <body>.
        if (preg_match('/<body\b[^>]*>(.*?)(<\/body>|$)/is', $raw, $m)) {
            $raw = $m[1];
        }
        $raw = preg_replace('/<!DOCTYPE[^>]*>|<\?xml[^>]*>|<!--.*?-->/is', '', $raw);
        $raw = preg_replace('/<head\b[^>]*>.*?<\/head>/is', '', $raw);
        // Markdown code fences that some AI tools wrap their answer in.
        $raw = preg_replace('/^\s*```[a-z]*\s*|\s*```\s*$/i', '', $raw);

        // Plain text with no tags at all: turn blank-line blocks into paragraphs.
        if (!preg_match('/<[a-z][^>]*>/i', $raw)) {
            $paras = preg_split('/\R{2,}/', trim($raw));
            $raw = implode('', array_map(fn ($p) => '<p>' . nl2br(e(trim($p))) . '</p>', $paras));
        }

        $doc = new DOMDocument('1.0', 'UTF-8');
        $prev = libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="UTF-8"><div id="ij-root">' . $raw . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NONET);
        libxml_clear_errors();
        libxml_use_internal_errors($prev);

        $root = $doc->getElementById('ij-root') ?? $doc->documentElement;
        if (!$root) {
            return ['html' => '', 'toc' => [], 'text' => ''];
        }

        self::clean($root);
        self::removeTitleHeading($root, $pageTitle);
        self::demoteH1($doc, $root);
        self::wrapTables($doc, $root);
        self::dropEmpty($root);
        $toc = self::numberHeadings($root);

        $html = '';
        foreach (iterator_to_array($root->childNodes) as $child) {
            $html .= $doc->saveHTML($child);
        }

        $text = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags(str_replace('<', ' <', $html)),ENT_QUOTES | ENT_HTML5, 'UTF-8')));

        return ['html' => trim($html), 'toc' => $toc, 'text' => $text];
    }

    /** Plain-text version for meta descriptions and reading time. */
    public static function text(?string $raw): string
    {
        return self::render($raw)['text'];
    }

    private static function clean(DOMNode $node): void
    {
        foreach (iterator_to_array($node->childNodes) as $child) {
            if ($child->nodeType === XML_COMMENT_NODE || $child->nodeType === XML_PI_NODE) {
                $node->removeChild($child);
                continue;
            }
            if (!$child instanceof DOMElement) {
                continue;
            }

            $tag = strtolower($child->nodeName);

            if (in_array($tag, self::DROP, true) || ($tag === 'iframe' && !self::allowedIframe($child))) {
                $node->removeChild($child);
                continue;
            }

            self::clean($child);

            $keepSpan = $tag === 'span' && preg_match('/(^|\s)ij-/', $child->getAttribute('class'));
            if (in_array($tag, self::UNWRAP, true) && !$keepSpan) {
                while ($child->firstChild) {
                    $node->insertBefore($child->firstChild, $child);
                }
                $node->removeChild($child);
                continue;
            }

            self::cleanAttributes($child, $tag);
        }
    }

    private static function cleanAttributes(DOMElement $el, string $tag): void
    {
        $classes = [];
        foreach (iterator_to_array($el->attributes) as $attr) {
            $name = strtolower($attr->nodeName);
            if ($name === 'class') {
                $classes = array_values(array_filter(preg_split('/\s+/', $attr->nodeValue), fn ($c) => str_starts_with($c, 'ij-')));
                $el->removeAttribute($attr->nodeName);
                continue;
            }
            if (!in_array($name, self::ATTRS, true)) {
                $el->removeAttribute($attr->nodeName);
                continue;
            }
            if (in_array($name, ['href', 'src', 'cite'], true) && preg_match('/^\s*(javascript|vbscript|data):/i', $attr->nodeValue)
                && !($tag === 'img' && preg_match('/^\s*data:image\/(png|jpe?g|gif|webp);/i', $attr->nodeValue))) {
                $el->removeAttribute($attr->nodeName);
            }
        }

        // Fixed pixel sizes only make sense on images and video frames.
        if (!in_array($tag, ['img', 'iframe'], true)) {
            $el->removeAttribute('width');
            $el->removeAttribute('height');
        }
        if ($classes) {
            $el->setAttribute('class', implode(' ', array_unique($classes)));
        }
        if ($tag === 'img') {
            $el->setAttribute('loading', 'lazy');
            if (!$el->hasAttribute('alt')) {
                $el->setAttribute('alt', '');
            }
        }
        if ($tag === 'a' && preg_match('#^https?://#i', $el->getAttribute('href'))
            && !preg_match('#^https?://(www\.)?theijsreat\.com#i', $el->getAttribute('href'))) {
            $el->setAttribute('target', '_blank');
            $el->setAttribute('rel', 'noopener');
        }
        if ($tag === 'iframe') {
            $el->setAttribute('loading', 'lazy');
            $el->setAttribute('allowfullscreen', '');
        }
    }

    private static function allowedIframe(DOMElement $el): bool
    {
        $host = parse_url($el->getAttribute('src'), PHP_URL_HOST);
        return $host && in_array(strtolower($host), self::IFRAME_HOSTS, true);
    }

    /** The page band already shows the title, so a first heading repeating it is removed. */
    private static function removeTitleHeading(DOMElement $root, ?string $pageTitle): void
    {
        if (!$pageTitle) {
            return;
        }
        $first = (new DOMXPath($root->ownerDocument))->query('.//h1|.//h2', $root)->item(0);
        if ($first && self::norm($first->textContent) === self::norm($pageTitle)) {
            $first->parentNode->removeChild($first);
        }
    }

    /** The page has one h1 (the title); headings inside the content start at h2. */
    private static function demoteH1(DOMDocument $doc, DOMElement $root): void
    {
        foreach (iterator_to_array($root->getElementsByTagName('h1')) as $h1) {
            $h2 = $doc->createElement('h2');
            while ($h1->firstChild) {
                $h2->appendChild($h1->firstChild);
            }
            if ($h1->hasAttribute('class')) {
                $h2->setAttribute('class', $h1->getAttribute('class'));
            }
            $h1->parentNode->replaceChild($h2, $h1);
        }
    }

    private static function wrapTables(DOMDocument $doc, DOMElement $root): void
    {
        foreach (iterator_to_array($root->getElementsByTagName('table')) as $table) {
            $parent = $table->parentNode;
            if ($parent instanceof DOMElement && str_contains(' ' . $parent->getAttribute('class') . ' ', ' ij-table ')) {
                continue;
            }
            $wrap = $doc->createElement('div');
            $wrap->setAttribute('class', 'ij-table');
            $parent->replaceChild($wrap, $table);
            $wrap->appendChild($table);
        }
    }

    /** Removes empty paragraphs and wrappers left behind by pasted spacing (&nbsp;, <p><br></p>). */
    private static function dropEmpty(DOMElement $root): void
    {
        $xp = new DOMXPath($root->ownerDocument);
        foreach (iterator_to_array($xp->query('.//p|.//div|.//section|.//h2|.//h3|.//h4|.//li', $root)) as $el) {
            if (trim(str_replace("\xC2\xA0", ' ', $el->textContent)) === ''
                && $xp->query('.//img|.//iframe|.//table|.//hr', $el)->length === 0) {
                $el->parentNode->removeChild($el);
            }
        }
    }

    /** @return array<int, array{id: string, text: string}> */
    private static function numberHeadings(DOMElement $root): array
    {
        $toc = [];
        $used = [];
        foreach (iterator_to_array($root->getElementsByTagName('h2')) as $h2) {
            $text = trim(preg_replace('/\s+/u', ' ', $h2->textContent));
            $id = Str::slug($text) ?: 'section';
            $base = $id;
            for ($i = 2; isset($used[$id]); $i++) {
                $id = $base . '-' . $i;
            }
            $used[$id] = true;
            $h2->setAttribute('id', $id);
            $toc[] = ['id' => $id, 'text' => $text];
        }
        return $toc;
    }

    private static function norm(string $s): string
    {
        return Str::lower(trim(preg_replace('/[^\p{L}\p{N}]+/u', ' ', html_entity_decode($s, ENT_QUOTES | ENT_HTML5, 'UTF-8'))));
    }
}
