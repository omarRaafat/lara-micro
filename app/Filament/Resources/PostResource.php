<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('author_name')
                ->label('Author Name')
                ->formatStateUsing(fn ($record) => $record?->user?->name)
                ->disabled(fn (string $context): bool => $context === 'edit'),
                Forms\Components\Textarea::make('body')
                ->required()
                ->label('Body'),
                TextInput::make('visitor'),
                TextInput::make('views')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('user.name')->label('Writer')->searchable(),
                TextColumn::make('views'),
                TextColumn::make('visitor'),
                TextColumn::make('is_approved')
                            ->label('Approval')
                            ->color(fn($record) => $record->is_approved == 'Pending' ? 'green' : 'orange')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('Post Approval')
                ->label('Approve')
                ->action(function ($record) {
                    $record->update(['is_approved' => 1]); 
                })
                ->icon('heroicon-o-check')
                ->requiresConfirmation()
                ->color('success')
                ->visible(fn($record) => $record->is_approved == 'Pending')

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
