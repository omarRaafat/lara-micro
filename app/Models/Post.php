<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['user_id' , 'body'];
    protected $casts = ['body' => 'array'];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('post_image');
    }

    public function comments(): MorphMany{
        return $this->morphMany(Comment::class,'commentable');
    }
}
