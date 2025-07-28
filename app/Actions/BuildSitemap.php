<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Material;
use App\Models\MaterialCategory;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class BuildSitemap
{
    public function build(): void
    {
        Sitemap::create()
            ->add($this->build_index(Material::displayed()->get(), 'sitemap_articles.xml'))
            ->add($this->build_index(MaterialCategory::all(), 'sitemap_categories.xml'))
            ->add(Url::create('/')->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create('/tipus/article')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/tipus/youtube')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/tipus/podcast')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/terms-and-conditions')->setPriority(0.2)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/privacy-policy')->setPriority(0.2)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->writeToFile(public_path('sitemap.xml'));
    }

    private function build_index(iterable $model, string $path): string
    {
        Sitemap::create()
            ->add($model)
            ->writeToFile(public_path("{$path}"));

        return $path;
    }
}
