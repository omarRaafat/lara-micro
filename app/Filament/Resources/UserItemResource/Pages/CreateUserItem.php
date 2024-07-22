<?php

namespace App\Filament\Resources\UserItemResource\Pages;

use App\Filament\Resources\UserItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserItem extends CreateRecord
{
    protected static string $resource = UserItemResource::class;
}
