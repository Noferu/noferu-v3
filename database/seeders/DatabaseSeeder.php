<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeder principal de l'application.
 */
final class DatabaseSeeder extends Seeder
{
    /**
     * Exécute tous les seeders.
     */
    public function run(): void
    {
        // Utilisateur de test
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
        ]);
    }
}
