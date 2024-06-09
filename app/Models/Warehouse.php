<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Warehouse extends Model
{
    use HasFactory , HasTranslations;
    
    protected $translatable = ['name'];

    protected $fillable = [
        'name',
        'user_id',
        'is_active'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];
    public function warehouseArea():HasOne { 
        return $this->hasOne(WarehouseArea::class ,'warehouse_id');
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function isActive():Attribute{
        return Attribute::make(
            get:fn($is_active)=> $is_active == true? 'Active' : 'inActive'
          
        );
    }
  
}
