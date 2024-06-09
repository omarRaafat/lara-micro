<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Translatable\HasTranslations;

class Country extends Model 
{
    use HasFactory ,HasTranslations;

    protected $translatable = ['name'];

    public function cities() : HasMany{
        return $this->hasMany(City::class , 'country_id' , 'id');
    }

    public function areas():HasManyThrough{
        return $this->hasManyThrough(Area::class , City::class , 'country_id' , 'city_id' , 'id' , 'id');
    }
}
