import axios from 'axios';

const baseURL = process.env.VITE_API_BASE_URL || process.env.SITEMAP_BASE_URL || 'https://panel.ijsreat.com/api/';
const apiKey = process.env.VITE_API_KEY || process.env.SITEMAP_API_KEY || '';

export default function axiosClientSitemap() {
  const headers = {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  };

  if (apiKey) {
    headers.Authorization = apiKey;
  }

  return axios.create({
    baseURL,
    headers,
    timeout: 30000,
  });
}
