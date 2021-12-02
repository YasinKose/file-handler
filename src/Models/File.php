<?php

namespace YasinKose\FileHandler\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'created_by',
    ];

    /**
     * @return MorphTo
     */
    public function filedable(): MorphTo
    {
        return $this->morphTo();
    }
}
