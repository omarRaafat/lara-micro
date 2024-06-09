<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory , HasTranslations;
    protected $translatable = ['name'];

    public function areas(): HasMany{
        return $this->hasMany(Area::class , 'city_id' , 'id');
    }

    public function country():BelongsTo{
        return $this->belongsTo(Country::class , 'country_id' , 'id');
    }
}
