<?php

namespace App\Filament\Resources\SystemPages\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SystemPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('slug')->badge()->sortable(),
                TextColumn::make('meta_title')->label('SEO Title')->limit(40)->toggleable(),
                TextColumn::make('meta_description')->label('SEO Desc')->limit(40)->toggleable(),
                ImageColumn::make('banner_image')
                    ->label('Banner')
                    ->disk('public')
                    ->height(40),
                IconColumn::make('is_published')->boolean(),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('slug')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([]);
    }
}
