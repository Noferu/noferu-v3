<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Média associé à un projet (image, vidéo, etc.).
 *
 * @property int         $id
 * @property int         $project_id
 * @property string      $type
 * @property string      $path
 * @property string|null $alt
 * @property int|null    $order
 * @property-read Project $project
 */
final class Media extends Model
{
    /** @var array<int, string> */
    protected $fillable = ['project_id', 'type', 'path', 'alt', 'order'];

    /**
     * Projet parent.
     *
     * @return BelongsTo<Project, Media>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
