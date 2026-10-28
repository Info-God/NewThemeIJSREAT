/**
 * SEO-Optimized Multi-Sitemap Generator for IJSREAT Journal
 * With DEBUG logging to identify PDF URL extraction issues
 */

import fs from 'fs';
import path from 'path';
import { SitemapStream, streamToPromise } from 'sitemap';
import axiosClientSitemap from './axios-client.js';

const api = axiosClientSitemap();
const HOST = process.env.VITE_API_HOST_URL || process.env.SITEMAP_BASE_URL || 'https://www.ijsreat.com';
const OUTPUT_DIR = './public/sitemaps';
const MAIN_SITEMAP_PATH = './public/sitemap.xml';

/**
 * Ensure output directory exists
 */
function ensureOutputDir() {
  if (!fs.existsSync(OUTPUT_DIR)) {
    fs.mkdirSync(OUTPUT_DIR, { recursive: true });
    console.log(`✅ Created directory: ${OUTPUT_DIR}`);
  }
}

/**
 * Normalize and validate URL
 */
function normalizeUrl(value) {
  if (!value) return null;

  const trimmed = String(value).trim();
  if (!trimmed) return null;

  if (/^https?:\/\//i.test(trimmed)) {
    return trimmed;
  }

  return new URL(trimmed.startsWith('/') ? trimmed : `/${trimmed}`, HOST).toString();
}

/**
 * Generate URL slug from title
 */
function generateSlug(title) {
  if (!title) return '';

  return String(title)
    .toLowerCase()
    .trim()
    .replace(/\s+/g, '-')
    .replace(/[^a-z0-9\-]+/g, '')
    .replace(/\-+/g, '-')
    .replace(/^-+|-+$/g, '');
}

function generateConferenceIssueUrl(paper) {
  const year = paper?.year;
  const volume = paper?.volume;
  const issue = paper?.issue;
  const categoryName = paper?.category_name ?? '';

  if (!year || !volume || !issue || !categoryName) return null;

  return `/conference/${year}/volume-${volume}/issue-${issue}/${generateSlug(categoryName)}`;
}

function generateConferencePaperUrl(paper) {
  const title = paper?.title || paper?.paper_title || '';
  const doi = normalizeDoi(paper?.doi || paper?.paper_doi);

  if (doi) return `/conference/${doi}`;

  const slug = generateSlug(title);
  return slug ? `/conference/${slug}` : null;
}

function generateThesisIssueUrl(pub) {
  const year = pub?.thesis_year || pub?.year;
  const volume = pub?.thesis_volume || pub?.volume;

  if (year && volume) {
    return `/thesis/${year}/volume-${volume}`;
  }

  return null;
}

function generateThesisPaperUrl(paper) {
  const title = paper?.thesis_title || paper?.title || '';
  const doi = normalizeDoi(paper?.thesis_doi_no || paper?.doi);

  if (doi) return `/thesis/${doi}`;

  const slug = generateSlug(title);
  return slug ? `/thesis/${slug}` : null;
}

/**
 * Normalize DOI to plain identifier
 */
function normalizeDoi(value) {
  if (!value || typeof value !== 'string') return null;

  const trimmed = value.trim().replace(/\\/g, '');
  if (!trimmed || trimmed === '.') return null;

  const normalized = trimmed
    .replace(/^https?:\/\/(?:www\.)?doi\.org\//i, '')
    .replace(/\/+$/, '')
    .trim();

  if (!normalized || normalized === '.') return null;

  if (/^10\./i.test(normalized)) {
    return normalized;
  }

  return null;
}

/**
 * Create a new sitemap stream
 */
function createSitemapStream() {
  return new SitemapStream({ hostname: HOST });
}

/**
 * Add URL to sitemap with per-sitemap duplicate prevention
 */
function addUrl(url, changefreq = 'monthly', priority = 0.5, sitemapStream, urlTracker) {
  if (!url || !sitemapStream) return;

  const normalized = normalizeUrl(url);
  if (!normalized || urlTracker.has(normalized)) return;

  urlTracker.add(normalized);

  sitemapStream.write({
    url: normalized,
    changefreq,
    priority: Number(priority),
    lastmod: new Date().toISOString(),
  });
}

/**
 * Fetch data from API endpoint with fallback
 */
async function fetchFromEndpoint(endpoint) {
  try {
    const response = await api.post(endpoint);
    return response.data;
  } catch (error) {
    const status = error?.response?.status;
    const shouldTryGet = status === 405 || status === 404 || status === undefined;

    if (shouldTryGet) {
      try {
        const response = await api.get(endpoint);
        return response.data;
      } catch (getError) {
        console.error(`❌ Error fetching ${endpoint} via GET:`, getError.message || getError);
        return null;
      }
    }

    console.error(`❌ Error fetching ${endpoint} via POST:`, error.message || error);
    return null;
  }
}

/**
 * Fetch data with proper array extraction - IMPROVED with logging
 */
async function fetchDataListing(endpoint, dataPath) {
  const data = await fetchFromEndpoint(endpoint);
  
  // Debug: Log the structure of first item if available
  if (data && !Array.isArray(data) && data?.data && Array.isArray(data.data) && data.data.length > 0) {
    console.log(`   📝 Sample from ${endpoint}:`, Object.keys(data.data[0]).slice(0, 10));
  } else if (data && Array.isArray(data) && data.length > 0) {
    console.log(`   📝 Sample from ${endpoint}:`, Object.keys(data[0]).slice(0, 10));
  }
  
  if (Array.isArray(data)) return data;
  if (Array.isArray(data?.data)) {
    console.log(`   ✅ Found array in data.data for ${endpoint}, length: ${data.data.length}`);
    return data.data;
  }
  if (dataPath && data?.[dataPath]) {
    console.log(`   ✅ Found array in data.${dataPath} for ${endpoint}, length: ${data[dataPath].length}`);
    return data[dataPath];
  }
  if (dataPath && data?.data?.[dataPath]) {
    console.log(`   ✅ Found array in data.data.${dataPath} for ${endpoint}, length: ${data.data[dataPath].length}`);
    return data.data[dataPath];
  }
  
  console.log(`   ⚠️ No array found for ${endpoint}, returning empty array`);
  return [];
}

/**
 * Safely end sitemap stream and write to file
 */
async function finalizeSitemap(sitemapStream, urlTracker, outputPath, sitemapName) {
  try {
    sitemapStream.end();
    const sitemapData = await streamToPromise(sitemapStream);
    
    if (sitemapData && sitemapData.length > 0) {
      fs.writeFileSync(outputPath, sitemapData.toString());
      console.log(`✅ ${sitemapName}: ${outputPath} (${urlTracker.size} URLs)`);
    } else {
      // Create minimal valid sitemap for empty results
      const emptySitemap = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>${HOST}/</loc>
    <lastmod>${new Date().toISOString()}</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
</urlset>`;
      fs.writeFileSync(outputPath, emptySitemap);
      console.log(`⚠️ ${sitemapName}: EMPTY - created fallback (${urlTracker.size} URLs)`);
    }
    return urlTracker.size;
  } catch (error) {
    const isEmptySitemap = error.name === 'EmptySitemap' || 
                           (error.message && (error.message.includes('EmptySitemap') || error.message.includes('ended the stream')));
    if (isEmptySitemap) {
      const emptySitemap = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>${HOST}/</loc>
    <lastmod>${new Date().toISOString()}</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
</urlset>`;
      fs.writeFileSync(outputPath, emptySitemap);
      console.log(`⚠️ ${sitemapName}: was EMPTY - created fallback`);
      return 0;
    }
    throw error;
  }
}
async function collectSitemapSection(generator, sitemapStream, urlTracker) {
  const beforeCount = urlTracker.size;
  await generator(sitemapStream, urlTracker);
  return urlTracker.size - beforeCount;
}


/**
 * Generate STATIC PAGES SITEMAP
 */
async function generateStaticSitemap(sitemapStream, urlTracker) {
  
  const staticPages = [
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

  staticPages.forEach((path) => {
    addUrl(path, 'monthly', '0.8', sitemapStream, urlTracker);
  });
}

/**
 * Generate ARCHIVES SITEMAP
 */
async function generateArchivesSitemap(sitemapStream, urlTracker) {
  console.log('\n📚 Fetching archives data...');
  const dataList = await fetchDataListing('archiveList', 'papersList');

  if (Array.isArray(dataList) && dataList.length > 0) {
    console.log(`   📊 Total archive papers: ${dataList.length}`);
    dataList.forEach((paper, index) => {
      const doi = normalizeDoi(paper?.paper_doi || paper?.doi);
      const slug = generateSlug(paper?.paper_title || paper?.title);
      const year = paper?.year;
      const volume = paper?.volume;
      const issue = paper?.issue;
      
      // Log first few papers to understand structure
      if (index < 3) {
        console.log(`   📝 Sample paper ${index + 1}:`, {
          has_title: !!paper?.paper_title,
          has_doi: !!paper?.paper_doi,
          has_pdf: !!paper?.paper_pdf_url,
          keys: Object.keys(paper).slice(0, 8)
        });
      }

      if (year && volume && issue) {
        addUrl(`/archives/${year}/volume-${volume}/issue-${issue}`, 'monthly', '0.8', sitemapStream, urlTracker);
      }

      if (doi) {
        addUrl(`/archives/${doi}`, 'monthly', '0.9', sitemapStream, urlTracker);
      } else if (slug) {
        addUrl(`/archives/${slug}`, 'monthly', '0.8', sitemapStream, urlTracker);
      }
    });
  } else {
    console.log(`   ⚠️ No archive data found`);
  }
}

/**
 * Generate ARCHIVE PDFS SITEMAP - WITH DEBUGGING
 */
async function generateArchivePdfsSitemap(sitemapStream, urlTracker) {
  console.log('\n📄 Fetching PDF URLs from archives...');
  const dataList = await fetchDataListing('archiveList', 'papersList');

  if (Array.isArray(dataList) && dataList.length > 0) {
    console.log(`   📊 Total papers to check for PDFs: ${dataList.length}`);
    let pdfCount = 0;
    let nullCount = 0;
    let emptyCount = 0;
    
    dataList.forEach((paper, index) => {
      // Check all possible PDF URL field names
      const pdfUrl = paper?.paper_pdf_url || paper?.pdf_url || paper?.pdf_link || paper?.full_text_url;
      
      if (index < 5) {
        console.log(`   🔍 Paper ${index + 1} PDF check:`, {
          paper_pdf_url: paper?.paper_pdf_url,
          pdf_url: paper?.pdf_url,
          has_pdf: !!pdfUrl,
          pdf_value: pdfUrl ? pdfUrl.substring(0, 50) : 'null'
        });
      }
      
      if (pdfUrl && pdfUrl !== 'null' && pdfUrl !== '' && pdfUrl !== 'NULL') {
        addUrl(pdfUrl, 'yearly', '0.5', sitemapStream, urlTracker);
        pdfCount++;
      } else if (!pdfUrl) {
        nullCount++;
      } else if (pdfUrl === '' || pdfUrl === 'null') {
        emptyCount++;
      }
    });
    
    console.log(`   📊 PDF URL stats: ${pdfCount} valid, ${nullCount} null/undefined, ${emptyCount} empty strings`);
    console.log(`   ✅ Added ${urlTracker.size} unique PDF URLs to sitemap`);
  } else {
    console.log(`   ⚠️ No archive data found for PDF extraction`);
  }
}

/**
 * Generate BLOGS SITEMAP
 */
async function generateBlogsSitemap(sitemapStream, urlTracker) {
  console.log('\n📝 Fetching blogs data...');
  const blogList = await fetchDataListing('blogFetch', 'blogList');

  if (Array.isArray(blogList) && blogList.length > 0) {
    console.log(`   📊 Total blogs: ${blogList.length}`);
    blogList.forEach((blog) => {
      const slug = blog?.url_title || blog?.slug;
      if (slug) {
        addUrl(`/blogs/${slug}`, 'weekly', '0.7', sitemapStream, urlTracker);
      }
    });
  }
}

/**
 * Generate TAGS SITEMAP
 */
async function generateTagsSitemap(sitemapStream, urlTracker) {
  console.log('\n🏷️ Fetching tags data...');
  const tagList = await fetchDataListing('tagFetch', 'tagsList');

  if (Array.isArray(tagList) && tagList.length > 0) {
    console.log(`   📊 Total tags: ${tagList.length}`);
    tagList.forEach((tag) => {
      const slug = tag?.url_title || tag?.slug;
      if (slug) {
        addUrl(`/tag/${slug}`, 'weekly', '0.6', sitemapStream, urlTracker);
      }
    });
  }
}

/**
 * Generate CONFERENCE SITEMAP
 */
async function generateConferenceSitemap(sitemapStream, urlTracker) {
  console.log('\n🎤 Fetching conference data...');
  const conferenceList = await fetchDataListing('conferenceList', 'papersList');

  if (Array.isArray(conferenceList) && conferenceList.length > 0) {
    console.log(`   📊 Total conference papers: ${conferenceList.length}`);
    conferenceList.forEach((paper) => {
      const issueUrl = generateConferenceIssueUrl(paper);
      if (issueUrl) {
        addUrl(issueUrl, 'monthly', '0.8', sitemapStream, urlTracker);
      }

      const paperUrl = generateConferencePaperUrl(paper);
      if (paperUrl) {
        addUrl(paperUrl, 'monthly', '0.8', sitemapStream, urlTracker);
      }

      if (paper?.pdf_url) {
        addUrl(paper.pdf_url, 'yearly', '0.5', sitemapStream, urlTracker);
      }
    });
  }
}

/**
 * Generate THESIS SITEMAP
 */
async function generateThesisSitemap(sitemapStream, urlTracker) {
  console.log('\n📖 Fetching thesis data...');
  
  try {
    let publications = await fetchDataListing('publications', null);
    
    if (!publications.length) {
      console.log('   🔍 Trying thesisList endpoint...');
      publications = await fetchDataListing('thesisList', null);
    }

    if (Array.isArray(publications) && publications.length > 0) {
      console.log(`   📊 Total thesis publications: ${publications.length}`);
      publications.forEach((pub) => {
        const issueUrl = generateThesisIssueUrl(pub);
        if (issueUrl) {
          addUrl(issueUrl, 'monthly', '0.7', sitemapStream, urlTracker);
        }
      });

      const thesisList = await fetchDataListing('thesisList', null);
      if (Array.isArray(thesisList) && thesisList.length > 0) {
        thesisList.forEach((paper) => {
          const paperUrl = generateThesisPaperUrl(paper);
          if (paperUrl) {
            addUrl(paperUrl, 'monthly', '0.7', sitemapStream, urlTracker);
          }
        });
      }
    } else {
      console.log('   ⚠️ No thesis data found');
    }
  } catch (error) {
    console.error('   ❌ Failed to fetch thesis publications:', error.message);
  }
}

/**
 * Generate SITEMAP INDEX
 */
async function generateSitemapIndex(results) {
  const sitemaps = [
    { file: 'static.xml', count: results.static },
    { file: 'archives.xml', count: results.archives },
    { file: 'archive-pdfs.xml', count: results.pdfs },
    { file: 'blogs.xml', count: results.blogs },
    { file: 'tags.xml', count: results.tags },
    { file: 'conference.xml', count: results.conference },
    { file: 'thesis.xml', count: results.thesis },
  ];

  let indexContent = '<?xml version="1.0" encoding="UTF-8"?>\n';
  indexContent += '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n';

  sitemaps.forEach((sitemap) => {
    const lastMod = new Date().toISOString();
    indexContent += `  <sitemap>\n`;
    indexContent += `    <loc>${HOST}/sitemaps/${sitemap.file}</loc>\n`;
    indexContent += `    <lastmod>${lastMod}</lastmod>\n`;
    indexContent += `  </sitemap>\n`;
  });

  indexContent += '</sitemapindex>';

  fs.writeFileSync(MAIN_SITEMAP_PATH, indexContent);
  console.log(`\n✅ Sitemap index generated: ${MAIN_SITEMAP_PATH}`);
  
  const robotsPath = './public/robots.txt';
  if (!fs.existsSync(robotsPath)) {
    const robotsContent = `User-agent: *\nAllow: /\nSitemap: ${HOST}/sitemap.xml\n`;
    fs.writeFileSync(robotsPath, robotsContent);
    console.log(`✅ robots.txt created`);
  }
}

/**
 * Main sitemap generation orchestrator
 */
async function generateAllSitemaps() {
  console.log('\n🚀 Starting multi-sitemap generation with DEBUG...\n');
  console.log(`📍 Host: ${HOST}`);
  console.log(`📁 Output directory: ${OUTPUT_DIR}\n`);

  const startTime = Date.now();

  try {
    ensureOutputDir();

    const results = {
      static: await generateStaticSitemap(),
      archives: await generateArchivesSitemap(),
      pdfs: await generateArchivePdfsSitemap(),
      blogs: await generateBlogsSitemap(),
      tags: await generateTagsSitemap(),
      conference: await generateConferenceSitemap(),
      thesis: await generateThesisSitemap(),
    };

    console.log('\n📑 Generating sitemap index...\n');
    await generateSitemapIndex(results);

    const totalUrls = Object.values(results).reduce((sum, count) => sum + count, 0);
    const duration = ((Date.now() - startTime) / 1000).toFixed(2);

    console.log('\n✨ All sitemaps generated successfully!');
    console.log(`\n📊 Summary:`);
    console.log(`   - Total URLs indexed: ${totalUrls}`);
    console.log(`   - Time taken: ${duration}s`);
    console.log(`\n📌 Submit to Google: ${HOST}/sitemap.xml`);

  } catch (error) {
    console.error('\n❌ Error generating sitemaps:', error);
    process.exit(1);
  }
}

// Run generation
generateAllSitemaps();