<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SitemapGenerator
{
    protected $host;
    protected $apiKey;
    protected $apiBaseUrl;
    protected $outputPath;
    
    public function __construct()
    {
        $this->host = env('SITEMAP_BASE_URL', 'https://www.ijsreat.com');
        $this->apiKey = env('VITE_API_KEY');
        $this->apiBaseUrl = env('VITE_API_HOST_URL', 'https://panel.ijsreat.com');
        $this->outputPath = public_path();
        
        if (!file_exists($this->outputPath)) {
            mkdir($this->outputPath, 0755, true);
        }
    }
    
    /**
     * Main method to generate all sitemaps
     */
    public function generateAll()
    {
        Log::info('🚀 Starting sitemap generation...');
        Log::info("📍 Host: {$this->host}");
        Log::info("🔗 API Base: {$this->apiBaseUrl}");
        
        $startTime = microtime(true);
        
        try {
            $urls = [];
            
            // Collect all URLs from different sources
            $urls = array_merge($urls, $this->getStaticUrls());
            $urls = array_merge($urls, $this->getArchiveUrls());
            $urls = array_merge($urls, $this->getArchivePdfUrls());
            $urls = array_merge($urls, $this->getBlogUrls());
            $urls = array_merge($urls, $this->getTagUrls());
            $urls = array_merge($urls, $this->getTopicsUrls());
            $urls = array_merge($urls, $this->getConferenceUrls());
            $urls = array_merge($urls, $this->getThesisUrls());
            
            // Remove duplicates and filter invalid URLs
            $urls = array_values(array_unique(array_filter($urls)));
            
            // Generate main sitemap
            $this->generateSitemapFile($urls, 'sitemap.xml');
            
            $duration = round(microtime(true) - $startTime, 2);
            Log::info("✅ Sitemap generation completed! Total URLs: " . count($urls) . " in {$duration}s");
            
            return [
                'success' => true,
                'total_urls' => count($urls),
                'duration' => $duration,
                'message' => 'Sitemap generated successfully'
            ];
            
        } catch (\Exception $e) {
            Log::error('❌ Sitemap generation failed: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Get static pages URLs
     */
    protected function getStaticUrls()
    {
        $pages = [
            '/', '/contact-us', '/ethics', '/aim-and-scope', '/editorial-board',
            '/peer-review-policy', '/publication-ethics-policy', '/indexing-and-abstracting',
            '/FAQs', '/topics', '/call-for-papers', '/instruction-for-author',
            '/journal-publishing-process', '/guidance-for-ems', '/article-processing-charges',
            '/downloads', '/impact-Factor', '/paper-status', '/cross-mark-policy',
            '/archives', '/publications', '/thesis', '/conference', '/blogs', '/tag',
            '/top-10-journals-in-computer-science', '/best-computer-science-journals',
            '/fast-publication-computer-science-journals-list', '/fast-publishing-computer-science-journals',
            '/top-computer-science-journals-list', '/top-computer-science-journals',
            '/top-computer-science-journals-in-india', '/low-cost-computer-science-journals-in-india',
            '/google-scholar-computer-science-journals-list', '/journal-for-computer-science-research',
        ];
        
        $urls = [];
        foreach ($pages as $page) {
            $urls[] = $this->normalizeUrl($page);
        }
        
        Log::info("📄 Static pages: " . count($urls));
        return $urls;
    }
    
    /**
     * Get archive URLs
     */
    protected function getArchiveUrls()
    {
        Log::info('📚 Fetching archives...');
        $papers = $this->fetchData('/archiveList', [], 'papersList');
        
        $urls = [];
        if (is_array($papers) && count($papers) > 0) {
            foreach ($papers as $paper) {
                $title = $paper['paper_title'] ?? $paper['title'] ?? '';
                $slug = $this->generateSlug($title);
                $year = $paper['year'] ?? null;
                $volume = $paper['volume'] ?? null;
                $issue = $paper['issue'] ?? null;
                
                // Issue URL
                if ($year && $volume && $issue) {
                    $urls[] = $this->normalizeUrl("/archives/{$year}/volume-{$volume}/issue-{$issue}");
                }
                
                // Paper URL - slug-only canonical path
                if ($slug) {
                    $urls[] = $this->normalizeUrl("/archives/{$slug}");
                }
            }
        }
        
        Log::info("📊 Archives URLs: " . count($urls));
        return $urls;
    }
    
    /**
     * Get archive PDF URLs
     */
    protected function getArchivePdfUrls()
    {
        Log::info('📄 Fetching archive PDFs...');
        $papers = $this->fetchData('/archiveList', [], 'papersList');
        
        $urls = [];
        $pdfCount = 0;
        
        if (is_array($papers) && count($papers) > 0) {
            foreach ($papers as $paper) {
                $pdfUrl = $paper['paper_pdf_url'] ?? $paper['pdf_url'] ?? $paper['pdf_link'] ?? null;
                
                if ($pdfUrl && !in_array($pdfUrl, ['null', 'NULL', ''], true)) {
                    $urls[] = $this->normalizeUrl($pdfUrl);
                    $pdfCount++;
                }
            }
        }
        
        Log::info("📊 PDF URLs: {$pdfCount}");
        return $urls;
    }
    
    /**
     * Get blog URLs
     * API returns: { "blogList": [...] }
     */
    protected function getBlogUrls()
    {
        Log::info('📝 Fetching blogs...');
        $blogs = $this->fetchData('/blogFetch', [], 'blogList');
        
        $urls = [];
        if (is_array($blogs) && count($blogs) > 0) {
            foreach ($blogs as $blog) {
                $slug = $blog['url_title'] ?? $blog['slug'] ?? null;
                
                if ($slug) {
                    $urls[] = $this->normalizeUrl("/blogs/{$slug}");
                } else {
                    // Generate slug from title as fallback
                    $title = $blog['title'] ?? '';
                    if ($title) {
                        $slug = $this->generateSlug($title);
                        $urls[] = $this->normalizeUrl("/blogs/{$slug}");
                    }
                }
            }
            Log::info("📊 Blog URLs: " . count($urls));
        } else {
            Log::warning("⚠️ No blog data found (may be timeout issue)");
        }
        
        return $urls;
    }
    
    /**
     * Get tag URLs
     * API returns: { "tagsList": [...] }
     */
    protected function getTagUrls()
    {
        Log::info('🏷️ Fetching tags...');
        $tags = $this->fetchData('/tagFetch', [], 'tagsList');
        
        $urls = [];
        if (is_array($tags) && count($tags) > 0) {
            foreach ($tags as $tag) {
                $slug = $tag['url_title'] ?? $tag['slug'] ?? null;
                
                if ($slug) {
                    $urls[] = $this->normalizeUrl("/tag/{$slug}");
                } else {
                    $name = $tag['name'] ?? $tag['title'] ?? '';
                    if ($name) {
                        $slug = $this->generateSlug($name);
                        $urls[] = $this->normalizeUrl("/tag/{$slug}");
                    }
                }
            }
            Log::info("📊 Tag URLs: " . count($urls));
        } else {
            Log::warning("⚠️ No tag data found");
        }
        
        return $urls;
    }
    
    /**
     * Get topics URLs
     * API returns: { "success": true, "data": [...] }
     */
    protected function getTopicsUrls()
    {
        Log::info('📚 Fetching topics...');
        $topics = $this->fetchData('/topicsFetch', [], 'data');
        
        $urls = [];
        if (is_array($topics) && count($topics) > 0) {
            foreach ($topics as $topic) {
                $topicUrl = $topic['url'] ?? null;
                
                if ($topicUrl) {
                    $urls[] = $this->normalizeUrl($topicUrl);
                } elseif (isset($topic['id'])) {
                    $urls[] = $this->normalizeUrl("/topics/{$topic['id']}");
                }
            }
            Log::info("📊 Topics URLs: " . count($urls));
        } else {
            Log::warning("⚠️ No topics data found (may be timeout issue)");
        }
        
        return $urls;
    }
    
    /**
     * Get conference URLs
     */
    protected function getConferenceUrls()
    {
        Log::info('🎤 Fetching conferences...');
        $papers = $this->fetchData('/conferenceList', [], 'papersList');
        
        $urls = [];
        if (is_array($papers) && count($papers) > 0) {
            foreach ($papers as $paper) {
                // Issue URL
                $issueUrl = $this->generateConferenceIssueUrl($paper);
                if ($issueUrl) {
                    $urls[] = $this->normalizeUrl($issueUrl);
                }
                
                // Paper URL
                $paperUrl = $this->generateConferencePaperUrl($paper);
                if ($paperUrl) {
                    $urls[] = $this->normalizeUrl($paperUrl);
                }
                
                // PDF URL
                $pdfUrl = $paper['pdf_url'] ?? $paper['paper_pdf_url'] ?? null;
                if ($pdfUrl && !in_array($pdfUrl, ['null', 'NULL', ''], true)) {
                    $urls[] = $this->normalizeUrl($pdfUrl);
                }
            }
        }
        
        Log::info("📊 Conference URLs: " . count($urls));
        return $urls;
    }
    
    /**
     * Get thesis URLs
     * thesisDataListing requires: thesis_year, thesis_volume
     */
    protected function getThesisUrls()
    {
        Log::info('📖 Fetching thesis...');
        
        $urls = [];
        
        // First, get the list of available years
        // Since thesisYearListing returns 404, we'll try a different approach
        // We'll try common years and volumes
        
        $currentYear = date('Y');
        $startYear = $currentYear - 5; // Look back 5 years
        
        for ($year = $currentYear; $year >= $startYear; $year--) {
            for ($volume = 1; $volume <= 4; $volume++) {
                $papers = $this->fetchData('/thesisDataListing', [
                    'thesis_year' => (string)$year,
                    'thesis_volume' => (string)$volume
                ]);
                
                if (is_array($papers) && count($papers) > 0) {
                    Log::info("   Found thesis for year {$year}, volume {$volume}: " . count($papers) . " papers");
                    
                    // Add volume URL
                    $urls[] = $this->normalizeUrl("/thesis/{$year}/volume-{$volume}");
                    
                    // Add individual paper URLs
                    foreach ($papers as $paper) {
                        $doi = $this->normalizeDoi($paper['thesis_doi_no'] ?? $paper['doi'] ?? null);
                        $title = $paper['thesis_title'] ?? $paper['title'] ?? '';
                        $slug = $this->generateSlug($title);
                        
                        if ($doi) {
                            $urls[] = $this->normalizeUrl("/thesis/{$doi}");
                        } elseif ($slug) {
                            $urls[] = $this->normalizeUrl("/thesis/{$slug}");
                        }
                    }
                }
            }
        }
        
        Log::info("📊 Thesis URLs: " . count($urls));
        return $urls;
    }
    
    /**
     * Fetch data from API with retry logic
     * @param string $endpoint API endpoint path
     * @param array $params POST parameters
     * @param string|null $dataPath Key to extract data from response
     * @return array
     */
    protected function fetchData($endpoint, $params = [], $dataPath = null)
    {
        $maxRetries = 2;
        $retryCount = 0;
        
        while ($retryCount <= $maxRetries) {
            try {
                $url = rtrim($this->apiBaseUrl, '/') . '/api' . $endpoint;
                
                if ($retryCount === 0) {
                    Log::info("   🔄 POST {$url}");
                } else {
                    Log::info("   🔄 RETRY {$retryCount} POST {$url}");
                }
                
                if (!empty($params)) {
                    Log::debug("   Params: " . json_encode($params));
                }
                
                // IMPORTANT: API expects raw API key, NOT Bearer token
                $response = Http::timeout(60) // Increased timeout for large responses
                    ->withHeaders([
                        'Authorization' => $this->apiKey,
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])
                    ->post($url, $params);
                
                $statusCode = $response->status();
                
                if ($response->successful()) {
                    $data = $response->json();
                    return $this->extractData($data, $dataPath, $endpoint);
                }
                
                // Handle specific status codes
                if ($statusCode === 522 || $statusCode === 523 || $statusCode === 524) {
                    Log::warning("   ⚠️ Cloudflare error {$statusCode} for {$endpoint}");
                    $retryCount++;
                    if ($retryCount <= $maxRetries) {
                        Log::info("   ⏳ Waiting 5 seconds before retry...");
                        sleep(5);
                        continue;
                    }
                }
                
                if ($statusCode === 422) {
                    Log::warning("   ⚠️ Validation error for {$endpoint}");
                    Log::debug("   Response: " . substr($response->body(), 0, 300));
                    return [];
                }
                
                if ($statusCode === 404) {
                    Log::info("   ℹ️ No data found for {$endpoint}");
                    return [];
                }
                
                Log::warning("   ⚠️ Failed: Status {$statusCode}");
                Log::debug("   Response: " . substr($response->body(), 0, 300));
                
                return [];
                
            } catch (\Exception $e) {
                Log::error("   ❌ Error: " . $e->getMessage());
                $retryCount++;
                if ($retryCount <= $maxRetries) {
                    Log::info("   ⏳ Waiting 5 seconds before retry...");
                    sleep(5);
                    continue;
                }
                return [];
            }
        }
        
        return [];
    }
    
    /**
     * Extract data array from API response
     */
    protected function extractData($data, $dataPath = null, $endpoint = '')
    {
        if (empty($data)) {
            return [];
        }
        
        // Case 1: Direct array
        if (is_array($data) && isset($data[0])) {
            Log::debug("   ✅ Direct array with " . count($data) . " items");
            return $data;
        }
        
        // Case 2: Response has a specific data key
        if ($dataPath) {
            // Check for { "dataPath": [...] }
            if (isset($data[$dataPath]) && is_array($data[$dataPath])) {
                Log::debug("   ✅ Found '{$dataPath}' with " . count($data[$dataPath]) . " items");
                return $data[$dataPath];
            }
            
            // Check for { "data": { "dataPath": [...] } }
            if (isset($data['data'][$dataPath]) && is_array($data['data'][$dataPath])) {
                Log::debug("   ✅ Found 'data.{$dataPath}' with " . count($data['data'][$dataPath]) . " items");
                return $data['data'][$dataPath];
            }
        }
        
        // Case 3: Check common wrapper keys
        $wrappers = ['data', 'papersList', 'blogList', 'tagsList', 'result', 'results', 'list', 'records'];
        
        foreach ($wrappers as $wrapper) {
            if (isset($data[$wrapper]) && is_array($data[$wrapper])) {
                Log::debug("   ✅ Found '{$wrapper}' with " . count($data[$wrapper]) . " items");
                return $data[$wrapper];
            }
        }
        
        // Case 4: Nested in success.data
        if (isset($data['success']) && $data['success'] === true && isset($data['data'])) {
            if (is_array($data['data'])) {
                Log::debug("   ✅ Found 'success.data' with " . count($data['data']) . " items");
                return $data['data'];
            }
        }
        
        // Log the structure for debugging
        Log::warning("   ⚠️ Unexpected response structure for {$endpoint}");
        Log::debug("   Response keys: " . implode(', ', array_keys($data)));
        
        return [];
    }
    
    /**
     * Generate sitemap XML file
     */
    protected function generateSitemapFile($urls, $filename)
    {
        $urls = array_filter($urls, function($url) {
            return !empty($url) && filter_var($url, FILTER_VALIDATE_URL);
        });
        $urls = array_values(array_unique($urls));
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        
        $lastmod = Carbon::now()->toIso8601String();
        
        foreach ($urls as $url) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= "    <loc>" . htmlspecialchars($url, ENT_XML1, 'UTF-8') . "</loc>" . PHP_EOL;
            $xml .= "    <lastmod>{$lastmod}</lastmod>" . PHP_EOL;
            $xml .= '    <changefreq>monthly</changefreq>' . PHP_EOL;
            $xml .= '    <priority>0.5</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        }
        
        $xml .= '</urlset>';
        
        $filePath = $this->outputPath . '/' . $filename;
        file_put_contents($filePath, $xml);
        
        Log::info("✅ Generated {$filename} with " . count($urls) . " URLs at {$filePath}");
    }
    
    /**
     * Normalize URL
     */
    protected function normalizeUrl($value)
    {
        if (empty($value)) return null;
        
        $trimmed = trim($value);
        if (empty($trimmed)) return null;
        
        if (preg_match('/^https?:\/\//i', $trimmed)) {
            return $trimmed;
        }
        
        return rtrim($this->host, '/') . '/' . ltrim($trimmed, '/');
    }
    
    /**
     * Normalize DOI
     */
    protected function normalizeDoi($value)
    {
        if (empty($value) || !is_string($value)) return null;
        
        $trimmed = trim(str_replace('\\', '', $value));
        if (empty($trimmed) || $trimmed === '.') return null;
        
        $normalized = preg_replace('/^https?:\/\/(?:www\.)?doi\.org\//i', '', $trimmed);
        $normalized = rtrim($normalized, '/');
        
        if (empty($normalized) || $normalized === '.') return null;
        
        if (preg_match('/^10\./i', $normalized)) {
            return $normalized;
        }
        
        return null;
    }
    
    /**
     * Generate URL slug
     */
    protected function generateSlug($title)
    {
        if (empty($title)) return '';
        
        $slug = strtolower(trim($title));
        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = preg_replace('/[^a-z0-9\-]+/', '', $slug);
        $slug = preg_replace('/\-+/', '-', $slug);
        $slug = trim($slug, '-');
        
        return $slug;
    }
    
    /**
     * Generate conference issue URL
     */
    protected function generateConferenceIssueUrl($paper)
    {
        $year = $paper['year'] ?? null;
        $volume = $paper['volume'] ?? null;
        $issue = $paper['issue'] ?? null;
        $categoryName = $paper['category_name'] ?? '';
        
        if (!$year || !$volume || !$issue || !$categoryName) return null;
        
        $slug = $this->generateSlug($categoryName);
        return "/conference/{$year}/volume-{$volume}/issue-{$issue}/{$slug}";
    }
    
    /**
     * Generate conference paper URL
     */
    protected function generateConferencePaperUrl($paper)
    {
        $title = $paper['title'] ?? $paper['paper_title'] ?? '';
        $doi = $this->normalizeDoi($paper['doi'] ?? $paper['paper_doi'] ?? null);
        
        if ($doi) return "/conference/{$doi}";
        
        $slug = $this->generateSlug($title);
        return $slug ? "/conference/{$slug}" : null;
    }
}