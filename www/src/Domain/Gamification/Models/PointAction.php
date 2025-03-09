<?php

namespace Domain\Gamification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PointAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'action_name',
        'points',
        'description',
    ];

    /**
     * Relationship to user_points_history (point_action can have many history records).
     *
     * @return HasMany
     */
    public function userPointsHistory(): HasMany
    {
        return $this->hasMany(UserPointsHistory::class);
    }
}
