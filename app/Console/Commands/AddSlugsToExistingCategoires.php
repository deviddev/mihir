<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\MaterialCategory;

class AddSlugsToExistingCategoires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:slug';

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
        MaterialCategory::whereNull('slug')
            ->each(function (MaterialCategory $category) {
                $category->slug = Str::slug($category->name);
                $category->save();
            });
    }
}
