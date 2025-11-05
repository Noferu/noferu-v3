<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Tag de projet.
 *
 * @property int    $id
 * @property string $slug
 * @property string $name
 * @property string|null $color
 * @property-read \Illuminate\Database\Eloquent\Collection<Project> $projects
 */
final class Tag extends Model
{
    /** @var array<int, string> */
    protected $fillable = ['slug', 'name', 'color'];

    /**
     * Projets associés au tag.
     *
     * @return BelongsToMany<Project>
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * Utilise le slug dans les URLs (Route Model Binding).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
