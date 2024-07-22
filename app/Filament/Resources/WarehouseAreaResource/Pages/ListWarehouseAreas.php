<?php

namespace App\Filament\Resources\WarehouseAreaResource\Pages;

use App\Filament\Resources\WarehouseAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWarehouseAreas extends ListRecords
{
    protected static string $resource = WarehouseAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
