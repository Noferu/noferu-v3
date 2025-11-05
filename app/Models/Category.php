<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Catégorie de projets.
 *
 * @property int         $id
 * @property string      $slug
 * @property string      $name
 * @property-read \Illuminate\Database\Eloquent\Collection<Project> $projects
 */
final class Category extends Model
{
    /** @var array<int, string> */
    protected $fillable = ['slug', 'name'];

    /**
     * Projets rattachés à la catégorie.
     *
     * @return HasMany<Project>
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Utilise le slug dans les URLs (Route Model Binding).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
