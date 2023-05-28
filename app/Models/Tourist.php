<?php

namespace App\Models;

use App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tourist extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumb')
            ->singleFile();
    }
}
