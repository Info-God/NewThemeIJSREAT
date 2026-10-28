import fs from 'fs';
import { SitemapStream, streamToPromise } from 'sitemap';
import axiosClientSitemap from './axios-client.js';

const api = axiosClientSitemap();
const host = process.env.VITE_API_HOST_URL || process.env.SITEMAP_BASE_URL || 'https://ijsreat.com';
const outputPath = process.env.SITEMAP_OUTPUT_PATH || './public/sitemap.xml';
const seenUrls = new Set();

function normalizeUrl(value) {
  if (!value) return null;

  const trimmed = String(value).trim();
  if (!trimmed) return null;

  if (/^https?:\/\//i.test(trimmed)) {
    return trimmed;
  }

  return new URL(trimmed.startsWith('/') ? trimmed : `/${trimmed}`, host).toString();
}

function formatTitle(title) {
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

  return `/conference/${year}/volume-${volume}/issue-${issue}/${formatTitle(categoryName)}`;
}

function generateConferencePaperUrl(paper) {
  const title = paper?.title || paper?.paper_title || '';
  const doi = normalizeDoi(paper?.doi || paper?.paper_doi);

  if (doi) return `/conference/${doi}`;

  const slug = formatTitle(title);
  return slug ? `/conference/${slug}` : null;
}

function isValidDoi(value) {
  if (!value || typeof value !== 'string') return false;

  const trimmed = value.trim().replace(/\\/g, '');
  return /^10\.[^\s]+$/i.test(trimmed) || /^https?:\/\/(?:www\.)?doi\.org\//i.test(trimmed);
}

function normalizeDoi(value) {
  if (!value || typeof value !== 'string') return null;

  const trimmed = value.trim().replace(/\\/g, '');
  if (!trimmed || trimmed === '.') return null;

  const normalized = trimmed
    .replace(/^https?:\/\/(?:www\.)?doi\.org\//i, '')
    .replace(/\/+$/, '')
    .trim();

  if (!normalized) return null;

  if (/^10\./i.test(normalized)) {
    return normalized;
  }

  if (normalized.includes('/')) {
    return normalized;
  }

  return null;
}

function addUrl(url, changefreq, priority) {
  if (!url) return;

  const normalized = normalizeUrl(url);
  if (!normalized || seenUrls.has(normalized)) return;

  seenUrls.add(normalized);

  sitemapStream.write({
    url: normalized,
    changefreq,
    priority: Number(priority),
  });
}

function generateOldArchiveUrls(paper) {
  const urls = [];
  const year = paper?.year;
  const volume = paper?.volume;
  const issue = paper?.issue;
  const paperId = paper?.paper_id ?? paper?.id;
  const slug = formatTitle(paper?.paper_title || paper?.title);

  if (year && volume && issue) {
    urls.push(`/archives/paperlist?year=${year}&volume=${volume}&issue=${issue}`);
  }

  if (paperId) {
    urls.push(`/archives/paper-details?paperid=${paperId}&papertitle=${slug}`);
  }

  return urls;
}

function generateNewArchiveUrls(paper) {
  const urls = [];
  const year = paper?.year;
  const volume = paper?.volume;
  const issue = paper?.issue;
  const slug = formatTitle(paper?.paper_title || paper?.title);
  const doi = normalizeDoi(paper?.doi || paper?.paper_doi);

  if (year && volume && issue) {
    urls.push(`/archives/${year}/volume-${volume}/issue-${issue}`);
  }

  if (slug) {
    urls.push(`/archives/${slug}`);
  }

  if (doi) {
    urls.push(`/archives/${doi}`);
  }

  return urls;
}

function generateOldCurrentIssueUrls(paper) {
  const urls = [];
  const year = paper?.year;
  const volume = paper?.volume;
  const issue = paper?.issue;
  const paperId = paper?.id;
  const slug = formatTitle(paper?.title);

  if (year && volume && issue) {
    urls.push(`/current-issue/paperlist?year=${year}&volume=${volume}&issue=${issue}`);
  }

  if (paperId) {
    urls.push(`/current-issue/paper-details?paperid=${paperId}&papertitle=${slug}`);
  }

  return urls;
}

function generateNewCurrentIssueUrls(paper) {
  const urls = [];
  const year = paper?.year;
  const volume = paper?.volume;
  const issue = paper?.issue;
  const slug = formatTitle(paper?.title);
  const doi = normalizeDoi(paper?.doi);

  if (year && volume && issue) {
    urls.push(`/current-issue/${year}/volume-${volume}/issue-${issue}`);
  }

  if (slug) {
    urls.push(`/current-issue/${slug}`);
  }

  if (doi) {
    urls.push(`/current-issue/${doi}`);
  }

  return urls;
}

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
        console.error(`Error fetching ${endpoint} via GET:`, getError.message || getError);
        return null;
      }
    }

    console.error(`Error fetching ${endpoint} via POST:`, error.message || error);
    return null;
  }
}

async function fetchDataListing() {
  const data = await fetchFromEndpoint('archiveList');
  if (Array.isArray(data)) return data;
  if (Array.isArray(data?.data)) return data.data;
  return [];
}

async function fetchConferenceListing() {
  const data = await fetchFromEndpoint('conferenceList');
  if (Array.isArray(data)) return data;
  if (Array.isArray(data?.data)) return data.data;
  return [];
}

async function fetchcurrentIssueList() {
  const data = await fetchFromEndpoint('currentIssueList');
  if (Array.isArray(data?.papersList)) return data.papersList;
  if (Array.isArray(data?.data?.papersList)) return data.data.papersList;
  return [];
}

async function fetchBlogListings() {
  const data = await fetchFromEndpoint('blogFetch');
  if (Array.isArray(data?.blogList)) return data.blogList;
  if (Array.isArray(data?.data?.blogList)) return data.data.blogList;
  return [];
}

async function fetchTagListings() {
  const data = await fetchFromEndpoint('tagFetch');
  if (Array.isArray(data?.tagsList)) return data.tagsList;
  if (Array.isArray(data?.data?.tagsList)) return data.data.tagsList;
  return [];
}

const sitemapStream = new SitemapStream({ hostname: host });

async function generateSitemap() {
  const staticUrls = [
    ['/', 'daily', '1.0'],
    ['/contact-us', 'monthly', '0.9'],
    ['/ethics', 'monthly', '0.8'],
    ['/blogs', 'weekly', '0.85'],
    ['/tag', 'weekly', '0.85'],
    ['/aim-and-scope', 'monthly', '0.85'],
    ['/editorial-board', 'monthly', '0.8'],
    ['/peer-review-policy', 'monthly', '0.8'],
    ['/publication-ethics-policy', 'monthly', '0.8'],
    ['/indexing-and-abstracting', 'monthly', '0.8'],
    ['/FAQs', 'monthly', '0.75'],
    ['/topics', 'monthly', '0.8'],
    ['/call-for-papers', 'monthly', '0.9'],
    ['/instruction-for-author', 'monthly', '0.85'],
    ['/journal-publishing-process', 'monthly', '0.8'],
    ['/guidance-for-ems', 'monthly', '0.75'],
    ['/article-processing-charges', 'monthly', '0.75'],
    ['/downloads', 'monthly', '0.7'],
    ['/impact-Factor', 'monthly', '0.85'],
    ['/paper-status', 'monthly', '0.8'],
    ['/cross-mark-policy', 'monthly', '0.75'],
    ['/archives', 'weekly', '0.9'],
    ['/publications', 'weekly', '0.9'],
    ['/thesis', 'weekly', '0.85'],
    ['/conference', 'monthly', '0.85'],
    ['/404', 'yearly', '0.1'],
    ['/top-10-journals-in-computer-science', 'monthly', '0.8'],
    ['/best-computer-science-journals', 'monthly', '0.8'],
    ['/fast-publication-computer-science-journals-list', 'monthly', '0.8'],
    ['/fast-publishing-computer-science-journals', 'monthly', '0.8'],
    ['/top-computer-science-journals-list', 'monthly', '0.8'],
    ['/top-computer-science-journals', 'monthly', '0.8'],
    ['/top-computer-science-journals-in-india', 'monthly', '0.8'],
    ['/low-cost-computer-science-journals-in-india', 'monthly', '0.8'],
    ['/google-scholar-computer-science-journals-list', 'monthly', '0.8'],
    ['/journal-for-computer-science-research', 'monthly', '0.8'],
  ];

  for (const [path, changefreq, priority] of staticUrls) {
    addUrl(path, changefreq, priority);
  }

  const dataList = await fetchDataListing();
  const conferenceList = await fetchConferenceListing();
  const currentIssueList = await fetchcurrentIssueList();
  const blogList = await fetchBlogListings();
  const tagList = await fetchTagListings();

  if (Array.isArray(dataList)) {
    dataList.forEach((paper) => {
      generateOldArchiveUrls(paper).forEach((item) => addUrl(item, 'monthly', '0.4'));
      generateNewArchiveUrls(paper).forEach((item) => addUrl(item, 'monthly', '0.8'));

      if (paper?.paper_url) {
        addUrl(paper.paper_url, 'monthly', '0.5');
      }
    });
  }

  if (Array.isArray(currentIssueList)) {
    currentIssueList.forEach((paper) => {
      generateOldCurrentIssueUrls(paper).forEach((item) => addUrl(item, 'monthly', '0.8'));
      generateNewCurrentIssueUrls(paper).forEach((item) => addUrl(item, 'monthly', '0.8'));
    });
  }

  if (Array.isArray(conferenceList)) {
    conferenceList.forEach((paper) => {
      const issueUrl = generateConferenceIssueUrl(paper);
      if (issueUrl) {
        addUrl(issueUrl, 'monthly', '0.8');
      }

      const paperUrl = generateConferencePaperUrl(paper);
      if (paperUrl) {
        addUrl(paperUrl, 'monthly', '0.8');
      }

      if (paper?.pdf_url) {
        addUrl(paper.pdf_url, 'monthly', '0.5');
      }
    });
  }

  if (Array.isArray(blogList)) {
    blogList.forEach((blog) => {
      const slug = blog?.url_title || blog?.slug;
      if (slug) {
        addUrl(`/blogs/${slug}`, 'weekly', '0.7');
      }
    });
  }

  if (Array.isArray(tagList)) {
    tagList.forEach((tag) => {
      const slug = tag?.url_title || tag?.slug;
      if (slug) {
        addUrl(`/tag/${slug}`, 'weekly', '0.7');
      }
    });
  }

  sitemapStream.end();

  const sitemapData = await streamToPromise(sitemapStream);
  fs.writeFileSync(outputPath, sitemapData.toString());
  console.log(`✅ Sitemap generated successfully at ${outputPath}`);
}

generateSitemap().catch((error) => {
  console.error('Failed to generate sitemap:', error);
  process.exit(1);
});
