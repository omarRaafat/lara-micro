<?php

namespace App\Filament\Resources\WarehouseAreaResource\Pages;

use App\Filament\Resources\WarehouseAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWarehouseArea extends EditRecord
{
    protected static string $resource = WarehouseAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
