<?php

namespace App\Models;

use App\Observers\AreaObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory , HasTranslations;
    protected $translatable = ['name'];
    protected $guarded = [];

    protected static function boot(){
        parent::boot();
        self::observe(AreaObserver::class);
    }

    public function city():BelongsTo{
        return $this->belongsTo(City::class,'city_id' , 'id');
    }

    public function warehouses():HasMany{
        return $this->hasMany(WarehouseArea::class,'area_id' , 'id');
    }

    
}
