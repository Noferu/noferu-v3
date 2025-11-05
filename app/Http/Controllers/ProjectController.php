<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View as ViewContract;

/**
 * Catalogue des projets (listing + détail).
 */
final class ProjectController extends Controller
{
    /**
     * Liste les projets avec filtres éventuels (category, tag, search).
     *
     * @param  Request  $request
     * @return ViewContract
     */
    public function index(Request $request): ViewContract
    {
        $query = Project::with(['category', 'tags'])
            ->orderBy('year', 'desc')
            ->orderBy('order');

        if ($request->has('category')) {
            $query->byCategory($request->category);
        }

        if ($request->has('tag')) {
            $query->byTag($request->tag);
        }

        if ($request->has('search')) {
            $query->search($request->search);
        }

        $projects   = $query->get();
        $categories = Category::all();
        $tags       = Tag::all();

        return view('projects.index', compact('projects', 'categories', 'tags'));
    }

    /**
     * Affiche le détail d'un projet + 3 projets liés de la même catégorie.
     *
     * @param  Project  $project
     * @return ViewContract
     */
    public function show(Project $project): ViewContract
    {
        $project->load(['category', 'tags', 'media']);

        $relatedProjects = Project::where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->limit(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }
}
