<?php

namespace App\Models;

use App\Casts\PostApprovalCast;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['user_id' , 'body','is_approved'] ;
    protected $casts = [
        'body' => 'array',
        'is_approved' => PostApprovalCast::class
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('post_image');
    }

    public function comments(): MorphMany{
        return $this->morphMany(Comment::class,'commentable');
    }

    public function user() : BelongsTo{
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }
}
