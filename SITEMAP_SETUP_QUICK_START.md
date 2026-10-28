# Sitemap Multi-Generator - Quick Start Guide

## What's New?

Your journal website now has a **production-ready sitemap system** with:
- 7 separate sitemaps (organized by content type)
- Automatic duplicate prevention
- SEO-optimized priorities and change frequencies
- Canonical URL validation
- Memory-efficient streaming

## Files Changed/Added

| File | Action | Purpose |
|------|--------|---------|
| `scripts/generate-sitemaps-multi.js` | ✅ NEW | Main generator (700+ lines) |
| `package.json` | ✅ UPDATED | Added sitemap npm commands |
| `.gitignore` | ✅ UPDATED | Excludes generated sitemaps |
| `public/sitemaps/.gitkeep` | ✅ NEW | Preserves directory in git |
| `SITEMAP_ARCHITECTURE.md` | ✅ NEW | Complete documentation |

## Quick Commands

### Generate all sitemaps
```bash
npm run sitemap:generate
```

### Watch for changes and regenerate
```bash
npm run sitemap:watch
```

### Old command (still works)
```bash
npm run generate-sitemap
```

## Expected Output

After running `npm run sitemap:generate`, you'll have:

```
public/
├── sitemap.xml                    (index file - submit to Google)
└── sitemaps/
    ├── static.xml                 (30+ static pages)
    ├── archives.xml               (all archive papers with DOI/slug)
    ├── archive-pdfs.xml           (direct PDF links)
    ├── blogs.xml                  (blog articles)
    ├── tags.xml                   (tag pages)
    ├── conference.xml             (conference papers)
    └── thesis.xml                 (thesis publications)
```

## URL Examples

### Archive papers (both formats included)
- With DOI: `https://www.indjcst.com/archives/10.59256/indjcst.20260501018`
- Without DOI: `https://www.indjcst.com/archives/deep-learning-neural-networks`

### Removed (old URLs NOT in new sitemaps)
- ❌ `https://www.indjcst.com/archives/paper-details?paperid=123`
- ❌ `https://www.indjcst.com/archives/paperlist?year=2026`

## Integration Checklist

### Immediate (Do Now)
- [ ] Run `npm run sitemap:generate` to create sitemaps
- [ ] Verify files in `public/sitemaps/` directory
- [ ] Check that `sitemap.xml` exists

### Setup (Next 24 hours)
- [ ] Update Google Search Console:
  - Remove old `https://www.indjcst.com/sitemap.xml`
  - Submit new `https://www.indjcst.com/sitemap.xml`
- [ ] Monitor Search Console Coverage report
- [ ] Enable email alerts for sitemap issues

### Maintenance (Ongoing)
- [ ] Schedule daily regeneration (see Cron Job Setup below)
- [ ] Monitor for API errors in generation logs
- [ ] Check Google indexing weekly

## SEO Guarantees

✅ **Canonical URLs Match Blade Templates**
- Archive pages use canonical: `<link rel="canonical" href="/archives/...">` 
- Sitemaps include the same URLs

✅ **No Duplicate URLs**
- Set-based deduplication prevents repeats
- DOI preferred over slug when both available

✅ **Proper Change Frequencies**
| Content Type | Frequency | Priority |
|--------------|-----------|----------|
| Homepage | Daily | 1.0 |
| Policies | Monthly | 0.85 |
| Archives | Monthly | 0.8 |
| Blogs | Weekly | 0.7 |
| PDFs | Yearly | 0.5 |

✅ **No Old Query URLs**
- All `/paper-details?id=...` removed
- All `/paperlist?year=...` removed
- Clean canonical URLs only

## Cron Job Setup (Recommended)

Auto-generate sitemaps daily at 2 AM:

```bash
# Edit crontab
crontab -e

# Add this line
0 2 * * * cd /var/www/html/Frontend/indjcst_laravel_new_code && npm run sitemap:generate >> storage/logs/sitemap-gen.log 2>&1
```

Verify with:
```bash
crontab -l
```

## Troubleshooting

| Issue | Solution |
|-------|----------|
| **No sitemaps generated** | Check that API endpoints are accessible (archiveList, blogFetch, etc.) |
| **Old URLs still appearing** | Make sure you're using `generate-sitemaps-multi.js`, not old script |
| **File permission errors** | Ensure `public/` and `public/sitemaps/` are writable: `chmod 755 public/sitemaps/` |
| **Out of memory** | Sitemaps use streaming - shouldn't happen. Check API isn't returning huge payloads |
| **404 on PDF URLs** | Verify `paper_pdf_url` in API is absolute URL (`https://...`), not relative |

## File Size Expectations

Typical sizes (example):
- `sitemap.xml` (index): ~500 bytes
- `static.xml`: ~5-10 KB
- `archives.xml`: ~100-500 KB (depends on archive count)
- `archive-pdfs.xml`: ~50-200 KB
- Others: ~10-50 KB each

**Total: ~150-750 KB** (well within Google's 50 MB limit)

## API Endpoints Used

The generator calls these endpoints to fetch content:

1. `/api/archiveList` - Archive papers
2. `/api/paperList` - Alternative archive source
3. `/api/conferenceList` - Conference papers
4. `/api/currentIssueList` - Current issue papers
5. `/api/blogFetch` - Blog articles
6. `/api/tagFetch` - Blog tags

If any endpoint fails, the script logs the error and continues with others.

## Git Workflow

The new `.gitignore` prevents generated files from being committed:

```bash
# These are now ignored (generated, not source code)
public/sitemap.xml
public/sitemaps/*.xml

# This IS committed (preserves directory)
public/sitemaps/.gitkeep
```

So your workflow is:
1. Commit code changes
2. Run `npm run sitemap:generate` locally (files are ignored)
3. Deploy to production
4. Run `npm run sitemap:generate` on production

## Next Steps

1. **Test locally:**
   ```bash
   npm run sitemap:generate
   ls -lah public/sitemap.xml public/sitemaps/
   ```

2. **Validate XML:**
   ```bash
   npm install -g xmllint  # if needed
   xmllint --noout public/sitemap.xml
   ```

3. **Submit to Google Search Console**

4. **Monitor indexing** (24-48 hours typically)

## Support

- Full documentation: See `SITEMAP_ARCHITECTURE.md`
- Generator code: `scripts/generate-sitemaps-multi.js` (well-commented)
- Issues: Check API endpoints are working and returning valid data

---

**Generated:** 2026-05-26  
**For:** INDJCST (Indian Journal of Computer Science & Technology)  
**Domain:** https://www.indjcst.com
