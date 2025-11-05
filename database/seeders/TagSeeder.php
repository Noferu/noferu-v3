<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

/**
 * Seed des tags (stack dev / design / vidéo).
 */
final class TagSeeder extends Seeder
{
    /**
     * Exécute le seed.
     */
    public function run(): void
    {
        $tags = [
            // Dev
            ['slug' => 'laravel',       'name' => 'Laravel',       'color' => '#ff2d20'],
            ['slug' => 'php',           'name' => 'PHP',           'color' => '#777bb4'],
            ['slug' => 'javascript',    'name' => 'JavaScript',    'color' => '#f7df1e'],
            ['slug' => 'tailwind',      'name' => 'Tailwind CSS',  'color' => '#06b6d4'],
            ['slug' => 'mysql',         'name' => 'MySQL',         'color' => '#4479a1'],
            ['slug' => 'sqlite',        'name' => 'SQLite',        'color' => '#003b57'],

            // Design
            ['slug' => 'figma',         'name' => 'Figma',         'color' => '#f24e1e'],
            ['slug' => 'photoshop',     'name' => 'Photoshop',     'color' => '#31a8ff'],
            ['slug' => 'illustrator',   'name' => 'Illustrator',   'color' => '#ff9a00'],

            // Vidéo
            ['slug' => 'premiere-pro',  'name' => 'Premiere Pro',  'color' => '#9999ff'],
            ['slug' => 'after-effects', 'name' => 'After Effects', 'color' => '#9999ff'],
        ];

        // Ré-exécutable sans erreurs grâce à la contrainte unique sur slug
        Tag::upsert($tags, ['slug'], ['name', 'color']);
    }
}
