<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;

    protected $fillable = ['path', 'name', 'size', 'width', 'height','user_id', 'field' ];

    public function photoable()
    {
        return $this->morphTo();
    }
}
