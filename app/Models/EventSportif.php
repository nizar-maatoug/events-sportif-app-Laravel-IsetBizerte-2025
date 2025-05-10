<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class EventSportif extends Model
{
    /** @use HasFactory<\Database\Factories\EventSportifFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sport',
        'description',
        'location',
        'start_date',
        'end_date',
        'status',
        'user_id'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class);
    }

    public function logo(): MorphOne
    {
        return $this->morphOne(Photo::class,'photoable')->where('field', 'logo');
    }

    public function poster(): MorphOne
    {
        return $this->morphOne(Photo::class,'photoable')->where('field', 'poster');
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function(EventSportif $event){
            $event->slug = Str::slug($event->name);
        });
    }


    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
