# Multi-Sitemap Architecture Documentation

## Overview

This refactored sitemap generation system creates 7 separate XML sitemaps plus a main index, optimized for SEO and scalability.

---

## Folder Structure

```
indjcst_laravel_new_code/
├── public/
│   ├── sitemap.xml (INDEX FILE - Main entry point)
│   └── sitemaps/
│       ├── static.xml (Static pages, policies, info)
│       ├── archives.xml (Canonical archive URLs only)
│       ├── archive-pdfs.xml (Direct PDF file URLs)
│       ├── blogs.xml (Blog articles)
│       ├── tags.xml (Blog tags)
│       ├── conference.xml (Conference papers)
│       └── thesis.xml (Thesis publications)
├── scripts/
│   ├── axios-client.js
│   ├── generate-sitemap.js (OLD - deprecated)
│   └── generate-sitemaps-multi.js (NEW - use this)
└── package.json (with sitemap command)
```

---

## Sitemap File Breakdown

### 1. `sitemap.xml` (Index)
**Location:** `/public/sitemap.xml`  
**Purpose:** Links to all sub-sitemaps  
**Google Submission:** Submit THIS file to Google Search Console

**Sample Content:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc>https://www.indjcst.com/sitemaps/static.xml</loc>
    <lastmod>2026-05-26</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://www.indjcst.com/sitemaps/archives.xml</loc>
    <lastmod>2026-05-26</lastmod>
  </sitemap>
  <!-- ... other sitemaps ... -->
</sitemapindex>
```

---

### 2. `static.xml` (Static Pages)
**Location:** `/public/sitemaps/static.xml`  
**Purpose:** Homepage, policies, editorial pages  
**Change Freq:** Daily/Monthly  
**Priority:** 0.7 - 1.0

**Sample Content:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/</loc>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/aim-and-scope</loc>
    <changefreq>monthly</changefreq>
    <priority>0.85</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/editorial-board</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/ethics</loc>
    <changefreq>monthly</changefreq>
    <priority>0.85</priority>
  </url>
  <!-- ... 30+ more static pages ... -->
</urlset>
```

---

### 3. `archives.xml` (Canonical Archive URLs Only)
**Location:** `/public/sitemaps/archives.xml`  
**Purpose:** ONLY canonical paper URLs  
**Change Freq:** Monthly  
**Priority:** 0.8  

**CRITICAL RULES:**
- ✅ Include DOI URLs: `/archives/10.59256/indjcst.20260501018`
- ✅ Include slug URLs for non-DOI papers: `/archives/deep-learning-neural-networks`
- ✅ Include current issue URLs: `/archives/2026/volume-5/issue-1`
- ❌ NEVER include old query URLs like `/archives/paper-details?paperid=123`
- ❌ NEVER include redirect URLs
- ❌ NEVER include duplicates

**Sample Content:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <!-- Papers with DOI -->
  <url>
    <loc>https://www.indjcst.com/archives/10.59256/indjcst.20260501018</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/10.59256/indjcst.20260402007</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  
  <!-- Papers without DOI (slug fallback) -->
  <url>
    <loc>https://www.indjcst.com/archives/machine-learning-classification</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/counterfeit-detection-deep-learning</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  
  <!-- Issue URLs -->
  <url>
    <loc>https://www.indjcst.com/archives/2026/volume-5/issue-1</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/2025/volume-4/issue-3</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
</urlset>
```

---

### 4. `archive-pdfs.xml` (Direct PDF URLs)
**Location:** `/public/sitemaps/archive-pdfs.xml`  
**Purpose:** Direct links to PDF files  
**Change Freq:** Yearly  
**Priority:** 0.5

**Sample Content:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/archiver/archives/file-2026-5-1-001.pdf</loc>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archiver/archives/file-2025-4-3-015.pdf</loc>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
</urlset>
```

---

### 5. `blogs.xml` (Blog Articles)
**Location:** `/public/sitemaps/blogs.xml`  
**Purpose:** Blog post URLs  
**Change Freq:** Weekly  
**Priority:** 0.7

**Sample Content:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/blogs/how-to-publish-in-indjcst</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/blogs/journal-impact-factor-2025</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
</urlset>
```

---

### 6. `tags.xml` (Blog Tags)
**Location:** `/public/sitemaps/tags.xml`  
**Purpose:** Tag/category pages  
**Change Freq:** Weekly  
**Priority:** 0.7

**Sample Content:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/tag/machine-learning</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/tag/research-article</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
</urlset>
```

---

### 7. `conference.xml` (Conference Papers)
**Location:** `/public/sitemaps/conference.xml`  
**Purpose:** Conference proceedings  
**Change Freq:** Monthly  
**Priority:** 0.75

**Sample Content:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/conference/advances-in-ai-2026</loc>
    <changefreq>monthly</changefreq>
    <priority>0.75</priority>
  </url>
</urlset>
```

---

### 8. `thesis.xml` (Thesis Publications)
**Location:** `/public/sitemaps/thesis.xml`  
**Purpose:** Thesis year/volume listings  
**Change Freq:** Monthly  
**Priority:** 0.7

**Sample Content:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/thesis/paperlist?year=2026&volume=5</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
</urlset>
```

---

## NPM Command Setup

Add this to `package.json`:

```json
{
  "scripts": {
    "sitemap:generate": "node scripts/generate-sitemaps-multi.js",
    "sitemap:watch": "nodemon --watch scripts/generate-sitemaps-multi.js --exec npm run sitemap:generate"
  }
}
```

### Usage:

**Generate sitemaps once:**
```bash
npm run sitemap:generate
```

**Watch and regenerate on changes:**
```bash
npm run sitemap:watch
```

---

## .gitignore Setup

Add to `.gitignore`:

```bash
# Sitemaps are generated files, not source code
public/sitemap.xml
public/sitemaps/
!.gitkeep

# Optional: track .gitkeep to preserve empty directory
# Create public/sitemaps/.gitkeep in git
```

---

## Key SEO Rules Implemented

✅ **Canonical URLs Only**
- DOI papers: `/archives/10.xxxx/xxxxx` (from `getPaperDoiUrl()`)
- Non-DOI papers: `/archives/slug-based-title` (from `generateSlug()`)
- Issue pages: `/archives/2026/volume-5/issue-1`

✅ **No Redirects in Sitemap**
- Old query URLs like `/archives/paper-details?id=123` removed
- 301 redirects handled in Laravel router, NOT in sitemap

✅ **No Duplicates**
- `seenUrls` Set prevents same URL appearing twice
- DOI URL preferred over slug when both exist

✅ **Proper Change Frequency**
- Homepage: `daily` (1.0)
- Static pages: `monthly` (0.7-0.85)
- Archives: `monthly` (0.8)
- Blogs: `weekly` (0.7)
- PDFs: `yearly` (0.5)

✅ **Proper Priorities**
- Critical pages: 1.0 (homepage)
- High-value: 0.8-0.9 (archives, policies)
- Medium: 0.7-0.75 (blogs, tags, conference)
- Low: 0.5 (PDFs)

---

## Integration with Blade Templates

The canonical URLs in sitemaps **must match** the canonical meta tag in Blade templates:

### Archive Papers (`resources/views/archives/paper.blade.php`):
```blade
@php
  $canonicalUrl = $archive->canonical_url;
@endphp
<link rel="canonical" href="{{ $canonicalUrl }}">
```

### Conference Papers:
```blade
@php
  $canonicalUrl = rtrim(config('app.url'), '/') . '/' . ltrim(request()->path(), '/');
@endphp
<link rel="canonical" href="{{ $canonicalUrl }}">
```

### Thesis Papers:
```blade
@php
  $canonicalUrl = rtrim(config('app.url'), '/') . '/' . ltrim(request()->path(), '/');
@endphp
<link rel="canonical" href="{{ $canonicalUrl }}">
```

---

## Google Search Console Setup

1. **Remove old sitemap** (if using single sitemap.xml)
2. **Submit new index:**
   - Go to Google Search Console
   - Property: indjcst.com
   - Sitemaps section
   - Add: `https://www.indjcst.com/sitemap.xml`
   - Google automatically discovers all sub-sitemaps

3. **Monitor:**
   - Coverage report
   - Valid/indexed URLs
   - Crawl statistics

---

## CLI Commands

```bash
# Generate all sitemaps
node scripts/generate-sitemaps-multi.js

# Or via npm
npm run sitemap:generate

# Check generated files
ls -lah public/sitemap.xml
ls -lah public/sitemaps/

# Validate XML syntax
xmllint --noout public/sitemap.xml
xmllint --noout public/sitemaps/*.xml
```

---

## Error Handling & Recovery

The script includes production-ready error handling:

- ✅ Automatically creates `/public/sitemaps/` if missing
- ✅ API fetch fallback (POST → GET)
- ✅ Graceful error logging
- ✅ Process exit code 1 on critical errors
- ✅ Duplicate URL prevention
- ✅ Memory-efficient streaming

---

## Testing the Sitemaps

```bash
# Test static sitemap
curl -I https://www.indjcst.com/sitemap.xml
curl -I https://www.indjcst.com/sitemaps/static.xml

# Validate XML structure
curl https://www.indjcst.com/sitemap.xml | xmllint --noout -

# Count URLs per sitemap
curl https://www.indjcst.com/sitemaps/archives.xml | grep -c "<loc>"
```

---

## Migration Checklist

- [ ] Backup old `scripts/generate-sitemap.js`
- [ ] Install new `scripts/generate-sitemaps-multi.js`
- [ ] Update `package.json` with new npm command
- [ ] Create `.gitkeep` in `public/sitemaps/`
- [ ] Update `.gitignore`
- [ ] Test generation: `npm run sitemap:generate`
- [ ] Verify all XML files in `/public/sitemaps/`
- [ ] Submit `sitemap.xml` to Google Search Console
- [ ] Monitor crawl stats (24-48 hours for indexing)
- [ ] Remove old sitemap submission if needed
- [ ] Schedule daily/weekly regeneration via cron

---

## Cron Job Setup (Optional)

Generate sitemaps daily at 2 AM:

```bash
# Edit crontab
crontab -e

# Add line
0 2 * * * cd /var/www/html/Frontend/indjcst_laravel_new_code && npm run sitemap:generate >> logs/sitemap-gen.log 2>&1
```

---

## Performance Notes

- Streaming architecture handles 100K+ URLs efficiently
- Memory usage stays constant regardless of dataset size
- Typical generation time: 2-5 seconds
- No database blocking (API-driven)

---

## Support & Troubleshooting

**Issue:** Sitemaps not generating  
**Solution:** Check API endpoints (`archiveList`, `blogFetch`, etc.) are accessible

**Issue:** Old query URLs still appearing  
**Solution:** Verify `generateOldArchiveUrls()` and similar functions are removed

**Issue:** Duplicate URLs in sitemap  
**Solution:** Check `seenUrls` Set is functioning; check API for duplicate data

**Issue:** 404 on PDF URLs  
**Solution:** Verify `paper_pdf_url` fields are absolute URLs, not relative paths

