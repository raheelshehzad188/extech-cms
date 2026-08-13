<?php

namespace App\Filament\Resources\MenuItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')->searchable()->sortable(),
                TextColumn::make('location')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'footer' ? 'Footer Quick Links' : 'Header'),
                TextColumn::make('route_name')->label('Page')->toggleable(),
                TextColumn::make('url')->limit(30)->toggleable(),
                TextColumn::make('parent.label')->label('Parent')->toggleable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('sort_order')->sortable(),
            ])
            ->filters([
                SelectFilter::make('location')->options([
                    'header' => 'Header',
                    'footer' => 'Footer Quick Links',
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
