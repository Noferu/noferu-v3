<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Projet du portfolio.
 *
 * @property int                          $id
 * @property string                       $title
 * @property string                       $slug
 * @property string|null                  $summary
 * @property string|null                  $description
 * @property int|null                     $category_id
 * @property string|null                  $cover
 * @property bool                         $featured
 * @property int|null                     $year
 * @property string|null                  $url
 * @property array|null                   $metadata
 * @property int|null                     $order
 * @property-read Category|null           $category
 * @property-read \Illuminate\Database\Eloquent\Collection<Tag>   $tags
 * @property-read \Illuminate\Database\Eloquent\Collection<Media> $media
 *
 * @method static Builder|self featured()
 * @method static Builder|self byCategory(string $categorySlug)
 * @method static Builder|self byTag(string $tagSlug)
 * @method static Builder|self search(string $search)
 */
final class Project extends Model
{
    /** @var array<int, string> */
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'category_id',
        'cover',
        'featured',
        'year',
        'url',
        'metadata',
        'order',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'featured' => 'boolean',
        'metadata' => 'array',
        'year'     => 'integer',
    ];

    /**
     * Catégorie du projet.
     *
     * @return BelongsTo<Category, Project>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Tags du projet.
     *
     * @return BelongsToMany<Tag>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Médias attachés au projet (ordonnés).
     *
     * @return HasMany<Media>
     */
    public function media(): HasMany
    {
        return $this->hasMany(Media::class)->orderBy('order');
    }

    /**
     * Utilise le slug dans les URLs (Route Model Binding).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Portés en avant.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    /**
     * Filtre par slug de catégorie.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeByCategory(Builder $query, string $categorySlug): Builder
    {
        return $query->whereHas('category', function (Builder $q) use ($categorySlug): void {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Filtre par slug de tag.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeByTag(Builder $query, string $tagSlug): Builder
    {
        return $query->whereHas('tags', function (Builder $q) use ($tagSlug): void {
            $q->where('slug', $tagSlug);
        });
    }

    /**
     * Recherche simple sur le titre et le résumé.
     *
     * Note: si tu enchaînes d'autres conditions avant/after, pense à regrouper
     * ces OR dans une closure `where(function ($q) {...})` pour éviter les surprises.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query
            ->where('title', 'like', "%{$search}%")
            ->orWhere('summary', 'like', "%{$search}%");
    }
}
