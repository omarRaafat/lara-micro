<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Item extends Model
{
    use HasFactory;
    use Sluggable;

    public $fillable = ['title'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function users(){
        return $this->belongsToMany(User::class, 'item_user', 'item_id', 'user_id');
    }

    public function hasUserPost(): HasManyThrough{
        return $this->hasManyThrough(User::class , Post::class);
    }
}