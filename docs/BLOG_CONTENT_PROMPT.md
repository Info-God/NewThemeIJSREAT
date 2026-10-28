# IJSREAT blog content prompt

Copy everything inside the box below into ChatGPT, Gemini, Claude or any other AI tool.
Replace the three lines under **MY ARTICLE** with your topic, then paste the AI's answer
into the **Description** field of the blog (or tag) in the panel.

The website cleans whatever is pasted, so the page design cannot break even if the AI
sends a full HTML page, adds its own styles, or sends only `<p>` tags. Following this
prompt simply makes the article use IJSREAT's dedicated article design (steps, tip boxes,
FAQ, tables, call-to-action) instead of plain paragraphs.

---

```text
You are writing a blog article for the IJSREAT website, the International Journal of
Scientific Research in Engineering & Technology (e-ISSN 2583-1240, DOI prefix 10.59256/ijsreat,
published bi-monthly since 2021, open access, peer reviewed).

MY ARTICLE
Topic: <write the blog title here>
Audience: <for example: engineering students, PhD scholars, first-time authors>
Main points to cover: <a few points, or write "you decide">

OUTPUT RULES (follow all of them exactly)
1. Reply with ONLY an HTML fragment. No explanation before or after it, and no ``` code fences.
2. Do NOT write <!DOCTYPE>, <html>, <head>, <body>, <style>, <script>, <link>, <meta>,
   <header>, <nav>, <footer>, <form> or <button>.
3. Do NOT use style="..." attributes, inline CSS, fonts or colours. Do NOT use any class
   except the ij-* classes listed below. The website supplies all the design.
4. Do NOT repeat the article title as a heading. The page already shows it. Start with
   the intro paragraph.
5. Use <h2> for main sections and <h3> for sub-sections. Never use <h1>.
   Write 4 to 8 <h2> sections; they become the "On this page" menu.
6. Allowed tags: p, h2, h3, h4, strong, em, a, ul, ol, li, table, thead, tbody, tr, th,
   td, blockquote, figure, img, figcaption, hr, code, mark, details, summary, div, span.
7. Links: use full https:// addresses. Link to IJSREAT pages with these addresses only:
   https://www.ijsreat.com/call-for-papers
   https://www.ijsreat.com/current-issue
   https://www.ijsreat.com/archives
   https://www.ijsreat.com/editorial-board
   Submissions go to https://editorial.fdrpjournals.org/login?journal=2
8. Do not invent facts about IJSREAT (fees, indexing, impact factor, review time). If you
   are not sure about a fact, leave it out.
9. Length: 900 to 1,500 words. Plain, helpful English. Short paragraphs (2 to 4 sentences).

IJSREAT DESIGN BLOCKS (use them where they fit; each one is optional)

Intro paragraph (always first):
<p class="ij-lead">One or two sentences that say what the reader will learn.</p>

Callout boxes (one short paragraph each; start with a bold label):
<div class="ij-tip"><p><strong>Tip:</strong> ...</p></div>
<div class="ij-note"><p><strong>Note:</strong> ...</p></div>
<div class="ij-warning"><p><strong>Avoid this:</strong> ...</p></div>
<div class="ij-important"><p><strong>Important:</strong> ...</p></div>

Key takeaways (good near the top or the end):
<div class="ij-takeaways">
  <h3>Key takeaways</h3>
  <ul><li>...</li><li>...</li><li>...</li></ul>
</div>

Numbered steps (for any process or how-to):
<ol class="ij-steps">
  <li><h3>Step title</h3><p>What to do and why.</p></li>
  <li><h3>Step title</h3><p>...</p></li>
</ol>

Checklist:
<ul class="ij-checklist"><li>...</li><li>...</li></ul>

Cards (2 to 4 short items side by side, for comparisons or features):
<div class="ij-cards">
  <div class="ij-card"><h3>Title</h3><p>One or two sentences.</p></div>
  <div class="ij-card"><h3>Title</h3><p>...</p></div>
</div>

Table (normal HTML table with a header row):
<table>
  <thead><tr><th>Column</th><th>Column</th></tr></thead>
  <tbody><tr><td>...</td><td>...</td></tr></tbody>
</table>

Quote:
<blockquote><p>...</p></blockquote>

Small label inside text:
<span class="ij-badge">New</span>

FAQ (3 to 6 questions, as the last section before the call to action):
<h2>Frequently asked questions</h2>
<div class="ij-faq">
  <details><summary>Question?</summary><p>Answer.</p></details>
  <details><summary>Question?</summary><p>Answer.</p></details>
</div>

Call to action (always the very last block):
<div class="ij-cta">
  <h3>Ready to publish your research?</h3>
  <p>One sentence inviting the reader to submit to IJSREAT.</p>
  <a class="ij-btn" href="https://editorial.fdrpjournals.org/login?journal=2">Submit your paper</a>
</div>

ARTICLE SHAPE
ij-lead intro -> ij-takeaways -> 4 to 8 <h2> sections (use ij-steps, tables, cards and
callouts inside them where they help) -> FAQ -> ij-cta.
```

---

## What the website does with pasted content

| You paste | What the page shows |
|---|---|
| A full HTML page (`<html>`, `<head>`, `<style>`, its own header and footer) | Only the article inside `<body>`. Its styles, scripts, header, nav and footer are removed. |
| Only `<p>` tags, or text from Word | Paragraphs in the IJSREAT article design. |
| Plain text with no tags | Each blank-line-separated block becomes a paragraph. |
| `style="..."`, fonts, colours, other classes | Removed. Only `ij-*` classes are kept. |
| An `<h1>` or a heading that repeats the title | The repeated title is removed; other `<h1>`s become `<h2>`. |
| Tables | Styled and scrollable on phones. |
| YouTube or Vimeo embeds | Kept, full width. Other iframes are removed. |

The cleaning lives in `app/Support/ArticleHtml.php` and the design in the
"Article body" section of `resources/css/archive.css`. It is used on blog posts,
tag pages and author topic pages.
