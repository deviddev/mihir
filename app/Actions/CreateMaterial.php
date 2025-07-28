<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\MaterialData;
use App\Jobs\FetchAndUpdateMaterialImage;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\Source;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateMaterial
{
    public function handle(Source $source, MaterialData $materialData): Material
    {
        if ($material = Material::where('url', $materialData->url)->first()) {
            return $material;
        }

        $duplicateCheck = $this->checkForDuplicates($materialData->title);

        if ($duplicateCheck['is_duplicate']) {
            // Ha duplikátum, frissítjük a forrásokat és visszaadjuk az eredetit
            // return $this->handleDuplicateFound($duplicateCheck['original_material'], $source, $materialData);

            // Egyelőre csak log-oljuk
            Log::info('Duplicate found but saving anyway', [
                'title' => $materialData->title,
                'original_id' => $duplicateCheck['original_material']->id ?? null,
                'similarity' => $duplicateCheck['similarity_score'] ?? null,
            ]);
        }

        return DB::transaction(function () use ($source, $materialData): Material {
            $material = $source
                ->materials()
                ->create([
                    'title' => $materialData->title,
                    'description' => $materialData->description,
                    'body' => $materialData->body,
                    'author' => $materialData->author,
                    'published_at' => $materialData->publishedAt,
                    'feed_id' => $materialData->feedId,
                    'duration' => $materialData->duration,
                    'is_displayed' => $materialData->isDisplayed,
                    'url' => $materialData->url,
                    'image_url' => $materialData->imageUrl,
                    'comparison_slug' => $this->createComparisonSlug($materialData->title),
                    'keyword_fingerprint' => $this->getKeywordFingerprint($materialData->title),
                    'duplicate_sources' => [], // Üres tömb induláskor
                ]);

            // Fingerprint mentése külön táblába gyors kereséshez
            DB::table('material_fingerprints')->insert([
                'material_id' => $material->id,
                'fingerprint' => $material->keyword_fingerprint,
                'created_at' => now(),
            ]);

            // Kategória kezelés...
            if ($materialData->category) {
                $materialCategory = MaterialCategory::firstOrCreate(['name' => $materialData->category]);
                $material->category()->associate($materialCategory);
                Cache::forget('categories');
                $material->save();
            }

            if (filled($material->image_url) && $material->isArticle()) {
                FetchAndUpdateMaterialImage::dispatch($material)->afterCommit();
            }

            return $material;
        });
    }

    private function checkForDuplicates(string $title): array
    {
        $fingerprint = $this->getKeywordFingerprint($title);

        // Gyors fingerprint keresés
        $candidateIds = DB::table('material_fingerprints')
            ->where('fingerprint', $fingerprint)
            ->pluck('material_id');

        if ($candidateIds->isEmpty()) {
            return ['is_duplicate' => false];
        }

        // Pontos ellenőrzés a kandidátusokon
        $currentSlug = $this->createComparisonSlug($title);

        $candidates = Material::whereIn('id', $candidateIds)
            ->get(['id', 'title', 'comparison_slug']);

        foreach ($candidates as $candidate) {
            if ($this->slugsAreSimilar($currentSlug, $candidate->comparison_slug)) {
                return [
                    'is_duplicate' => true,
                    'original_material' => $candidate,
                    'similarity_score' => $this->calculateSimilarity($currentSlug, $candidate->comparison_slug)
                ];
            }
        }

        return ['is_duplicate' => false];
    }

    private function handleDuplicateFound(Material $originalMaterial, Source $source, MaterialData $materialData): Material
    {
        // Duplikátum forrás hozzáadása az eredeti anyaghoz
        $duplicateSources = $originalMaterial->duplicate_sources ?? [];

        $duplicateSources[] = [
            'source_id' => $source->id,
            'source_name' => $source->name,
            'url' => $materialData->url,
            'found_at' => now()->toISOString(),
            'title_variant' => $materialData->title,
        ];

        $originalMaterial->update([
            'duplicate_sources' => $duplicateSources
        ]);

        // Log-olás
        Log::info('Duplicate material found', [
            'original_id' => $originalMaterial->id,
            'original_title' => $originalMaterial->title,
            'duplicate_title' => $materialData->title,
            'source' => $source->name,
        ]);

        return $originalMaterial;
    }

    // Helper függvények a korábbi válaszból...
    private function createComparisonSlug(string $title): string
    {
        $normalized = mb_strtolower($title, 'UTF-8');
        $stopwords = ['a', 'az', 'egy', 'és', 'vagy', 'de', 'hogy', 'mint', 'már', 'még', 'is', 'el', 'be', 'ki', 'fel', 'le'];
        $words = explode(' ', $normalized);
        $words = array_diff($words, $stopwords);

        return Str::slug(implode(' ', array_slice($words, 0, 15)));
    }

    private function getKeywordFingerprint(string $title): string
    {
        $slug = $this->createComparisonSlug($title);
        $words = explode('-', $slug);

        $keywords = array_filter($words, fn($word) => strlen($word) > 3);
        sort($keywords);

        return md5(implode('', array_slice($keywords, 0, 5)));
    }

    private function slugsAreSimilar(string $slug1, string $slug2): bool
    {
        $distance = levenshtein($slug1, $slug2);
        $maxLen = max(strlen($slug1), strlen($slug2));

        $similarity = (1 - ($distance / $maxLen)) * 100;

        return $similarity > 85;
    }

    private function calculateSimilarity(string $slug1, string $slug2): float
    {
        $distance = levenshtein($slug1, $slug2);
        $maxLen = max(strlen($slug1), strlen($slug2));

        return round((1 - ($distance / $maxLen)) * 100, 2);
    }
}
