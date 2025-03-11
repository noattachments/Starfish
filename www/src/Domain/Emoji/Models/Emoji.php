<?php

namespace Domain\Emoji\Models;

use MongoDB\Laravel\Eloquent\Model;

class Emoji extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'emoji';
    protected $fillable = [
        'emoji',
        'hexcode',
        'group',
        'subgroup',
        'annotation',
        'tags',
        'shortcodes',
        'emoticons',
        'directional',
        'variation',
        'variationBase',
        'unicode',
        'order',
        'skintone',
        'skintoneCombination',
        'skintoneBase',
    ];
}
