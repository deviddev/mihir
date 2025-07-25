<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Material;

class AddSlugToExistingArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:slug-article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Material::whereNull('title_slug')
            ->chunkById(100, function ($materials) {
                $materials->each(function (Material $material) {
                    $baseSlug = Str::slug(str($material->title)->words(15));
                    $slug = $baseSlug;
                    $counter = 1;

                    while (Material::where('title_slug', $slug)->exists()) {
                        $slug = $baseSlug . '-' . $counter++;
                    }

                    $material->title_slug = $slug;
                    $material->save();
                });
            });
    }
}
