<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Seed des catégories.
 */
final class CategorySeeder extends Seeder
{
    /**
     * Exécute le seed.
     */
    public function run(): void
    {
        $categories = [
            ['slug' => 'dev',   'name' => 'Développement'],
            ['slug' => 'design','name' => 'Design'],
            ['slug' => 'video', 'name' => 'Vidéo'],
        ];

        Category::upsert($categories, ['slug'], ['name']);
    }
}
