<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehouseArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'area_id'
    ];

    public function warehouse():BelongsTo{
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function area():BelongsTo{
        return $this->belongsTo(Area::class, 'area_id');
    }
}
