# Sitemap Sample Outputs

This document shows real examples of what each generated sitemap will contain.

---

## 1. `public/sitemap.xml` (Index File)

This is the **main file** you submit to Google Search Console.

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
  <sitemap>
    <loc>https://www.indjcst.com/sitemaps/archive-pdfs.xml</loc>
    <lastmod>2026-05-26</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://www.indjcst.com/sitemaps/blogs.xml</loc>
    <lastmod>2026-05-26</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://www.indjcst.com/sitemaps/tags.xml</loc>
    <lastmod>2026-05-26</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://www.indjcst.com/sitemaps/conference.xml</loc>
    <lastmod>2026-05-26</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://www.indjcst.com/sitemaps/thesis.xml</loc>
    <lastmod>2026-05-26</lastmod>
  </sitemap>
</sitemapindex>
```

---

## 2. `public/sitemaps/static.xml`

Homepage, policies, editorial board, etc.

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
  <url>
    <loc>https://www.indjcst.com/privacy-policy</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/author-guidelines</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/contact</loc>
    <changefreq>monthly</changefreq>
    <priority>0.75</priority>
  </url>
  <!-- ... more static pages ... -->
</urlset>
```

---

## 3. `public/sitemaps/archives.xml` (MAIN - All Archive Papers)

**This is the most important sitemap.** Only canonical URLs here.

**Key Rules:**
- ✅ DOI-based URLs: `/archives/10.59256/indjcst.20260501018`
- ✅ Slug-based URLs: `/archives/machine-learning-classification`
- ✅ Issue URLs: `/archives/2026/volume-5/issue-1`
- ❌ NO old query URLs like `/archives/paper-details?paperid=123`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <!-- Volume 5, Issue 1 (2026) - Current -->
  <url>
    <loc>https://www.indjcst.com/archives/10.59256/indjcst.20260501018</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/10.59256/indjcst.20260501017</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/10.59256/indjcst.20260501001</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Volume 4, Issue 3 (2025) - With both DOI and slug examples -->
  <url>
    <loc>https://www.indjcst.com/archives/10.59256/indjcst.20254303015</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/10.59256/indjcst.20254303007</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Papers without DOI (using slug) -->
  <url>
    <loc>https://www.indjcst.com/archives/deep-learning-for-medical-image-analysis</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/cloud-computing-security-challenges</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/blockchain-distributed-systems</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Issue listing pages -->
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
  <url>
    <loc>https://www.indjcst.com/archives/2025/volume-4/issue-2</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archives/2025/volume-4/issue-1</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- ... More issues and papers from previous years ... -->
</urlset>
```

**Expected Size:** 100-500 KB (depending on number of papers)  
**Expected Entry Count:** 100-2000+ URLs

---

## 4. `public/sitemaps/archive-pdfs.xml`

Direct links to PDF files for indexing.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/archiver/archives/2026-5-1-018.pdf</loc>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archiver/archives/2026-5-1-017.pdf</loc>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archiver/archives/2026-5-1-001.pdf</loc>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archiver/archives/2025-4-3-015.pdf</loc>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/archiver/archives/2025-4-3-007.pdf</loc>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
  <!-- ... More PDFs ... -->
</urlset>
```

**Expected Size:** 50-200 KB  
**Expected Entry Count:** Same as archives (one PDF per paper)

---

## 5. `public/sitemaps/blogs.xml`

Blog articles and posts.

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
  <url>
    <loc>https://www.indjcst.com/blogs/peer-review-process-explained</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <!-- ... More blog posts ... -->
</urlset>
```

---

## 6. `public/sitemaps/tags.xml`

Blog tag/category pages.

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
  <url>
    <loc>https://www.indjcst.com/tag/publication-guidelines</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <!-- ... More tags ... -->
</urlset>
```

---

## 7. `public/sitemaps/conference.xml`

Conference proceedings and events.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/conference/advances-in-ai-2026</loc>
    <changefreq>monthly</changefreq>
    <priority>0.75</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/conference/digital-transformation-summit</loc>
    <changefreq>monthly</changefreq>
    <priority>0.75</priority>
  </url>
  <!-- ... More conferences ... -->
</urlset>
```

---

## 8. `public/sitemaps/thesis.xml`

Thesis publications and listings.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.indjcst.com/thesis/paperlist?year=2026&volume=5</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>https://www.indjcst.com/thesis/paperlist?year=2025&volume=4</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <!-- ... More thesis volumes ... -->
</urlset>
```

---

## Summary Table

| Sitemap | Entries | Size | Update Freq |
|---------|---------|------|-------------|
| static.xml | 30-50 | ~5-10 KB | Monthly |
| **archives.xml** | **100-2000+** | **100-500 KB** | Monthly |
| archive-pdfs.xml | 100-2000+ | 50-200 KB | Yearly |
| blogs.xml | 10-100 | 5-50 KB | Weekly |
| tags.xml | 5-50 | 2-20 KB | Weekly |
| conference.xml | 5-50 | 2-20 KB | Monthly |
| thesis.xml | 5-50 | 2-20 KB | Monthly |
| **sitemap.xml** | **7** | **~0.5 KB** | Monthly |
| **TOTAL** | **265-3,275** | **165-800 KB** | **N/A** |

---

## What NOT to See

The old generator had these patterns - **THEY SHOULD NOT APPEAR** in the new sitemaps:

```xml
<!-- ❌ REMOVED: Query-based archive URLs -->
<url>
  <loc>https://www.indjcst.com/archives/paper-details?paperid=123</loc>
</url>

<!-- ❌ REMOVED: Year-based listing with query params -->
<url>
  <loc>https://www.indjcst.com/archives/paperlist?year=2026</loc>
</url>

<!-- ❌ REMOVED: Invalid DOI values -->
<url>
  <loc>https://www.indjcst.com/archives/.</loc>
</url>

<!-- ❌ REMOVED: Current issue with query params -->
<url>
  <loc>https://www.indjcst.com/archives/current-issue?volume=5</loc>
</url>
```

---

## Testing Generated Sitemaps

### Syntax validation:
```bash
# Install xmllint if needed
sudo apt-get install libxml2-utils

# Validate each file
xmllint --noout public/sitemap.xml
xmllint --noout public/sitemaps/*.xml
```

### Count URLs in each sitemap:
```bash
grep -c "<loc>" public/sitemap.xml
grep -c "<loc>" public/sitemaps/archives.xml
grep -c "<loc>" public/sitemaps/blogs.xml
# ... etc
```

### Check for specific URL patterns:
```bash
# Should have DOI URLs
grep "10\.59256" public/sitemaps/archives.xml | head -5

# Should NOT have old query patterns
grep "paper-details\?" public/sitemaps/archives.xml
# (should return nothing)

# Should have proper domain
grep -o "https://www\.indjcst\.com" public/sitemaps/archives.xml | wc -l
```

---

## Next Steps

1. Run generator: `npm run sitemap:generate`
2. Verify files exist: `ls -lah public/sitemap.xml public/sitemaps/`
3. Validate XML: `xmllint --noout public/sitemap.xml`
4. Submit to Google Search Console
5. Monitor indexing (check back in 24-48 hours)

---

**Document Version:** 1.0  
**Updated:** 2026-05-26  
**For:** INDJCST Journal Platform
