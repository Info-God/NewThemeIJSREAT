<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate SEO-optimized sitemap for INDJCST Journal';

    public function handle()
    {
        $this->info('🚀 Starting sitemap generation...');
        
        $generator = new SitemapGenerator();
        $result = $generator->generateAll();
        
        if ($result['success']) {
            $this->info("✅ Sitemap generated successfully!");
            $this->info("📊 Total URLs: {$result['total_urls']}");
            $this->info("⏱️ Duration: {$result['duration']}s");
            $this->info("📌 Sitemap URL: " . env('SITEMAP_BASE_URL') . "/sitemap.xml");
        } else {
            $this->error("❌ Failed: {$result['message']}");
            return 1;
        }
        
        return 0;
    }
}