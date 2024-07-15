<?php

namespace App\Filament\Resources\UserItemResource\Pages;

use App\Filament\Resources\UserItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserItems extends ListRecords
{
    protected static string $resource = UserItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
