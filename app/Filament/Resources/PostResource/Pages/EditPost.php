<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use App\Filament\Resources\PostResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function beforeFill(){
        if($this->record->is_approved == 'Approved'){
            Notification::make()
                            ->title('Error')
                            ->body('You Can not edit this post , Already Approved !')
                            ->danger()
                            ->send();

             $this->redirect($this->getResource()::getUrl('index'));                
        }
    }
}
