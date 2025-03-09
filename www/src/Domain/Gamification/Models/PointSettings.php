<?php

namespace Domain\Gamification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_action_id',
        'points',
    ];

    /**
     * Relationship to PointAction (each point setting belongs to a point action).
     *
     * @return BelongsTo
     */
    public function pointAction(): BelongsTo
    {
        return $this->belongsTo(PointAction::class);
    }
}
