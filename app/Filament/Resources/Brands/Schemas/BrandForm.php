<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Brand Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->required()->maxLength(120),
                        TextInput::make('url')->label('Website URL')->url()->nullable(),
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('brands')
                            ->disk('public')
                            ->columnSpanFull(),
                        Toggle::make('is_published')->default(true),
                        TextInput::make('sort_order')->numeric()->default(0),
                    ]),
            ]);
    }
}
