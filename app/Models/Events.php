<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Events extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $primaryKey = 'events_id';

    protected $casts  = [
        'events_properties' => 'array'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('events')->singleFile();
    }
}
