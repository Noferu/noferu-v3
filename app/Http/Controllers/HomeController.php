<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\View\View as ViewContract;

/**
 * Page d'accueil.
 */
final class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil avec une sélection de projets mis en avant.
     *
     * @return ViewContract
     */
    public function index(): ViewContract
    {
        $featuredProjects = Project::with(['category', 'tags'])
            ->featured()
            ->orderBy('order')
            ->limit(3)
            ->get();

        return view('home.index', compact('featuredProjects'));
    }
}
