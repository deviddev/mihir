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
            ->each(function (Material $material) {
                $material->title_slug = Str::slug(
                    str($material->title)->words(15)
                );
                $material->save();
            });
    }
}
