<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\BuildSitemap as BuildSitemapAction;

class BuildSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = app(BuildSitemapAction::class);
        $sitemap->build();
    }
}
