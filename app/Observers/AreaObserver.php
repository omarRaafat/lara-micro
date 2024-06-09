<?php

namespace App\Observers;

use App\Models\Area;

class AreaObserver
{
    public function created(Area $area): void{
        $area->city->country->touch();
    }
}
