<?php

namespace Domain\Gamification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPointsHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'point_action_id',
        'points',
        'action_type',
        'description',
    ];

    /**
     * Relationship to User (each point history record belongs to a user).
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Relationship to PointAction (each point history record belongs to a point action).
     *
     * @return BelongsTo
     */
    public function pointAction(): BelongsTo
    {
        return $this->belongsTo(PointAction::class);
    }
}
