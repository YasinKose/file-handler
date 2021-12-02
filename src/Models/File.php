<?php

namespace YasinKose\FileHandler\Models\File;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'slug',
        'filable_type',
        'filable_id',
        'created_by',
    ];

    public function filable()
    {
        return $this->morphTo();
    }
}
