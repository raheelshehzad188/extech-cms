<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use App\Models\MenuItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->columns(2)->schema([
                    TextInput::make('label')->required(),
                    TextInput::make('url')->helperText('Or use route name below'),
                    TextInput::make('route_name')->helperText('Laravel route name e.g. services.index'),
                    Select::make('parent_id')
                        ->label('Parent')
                        ->options(fn () => MenuItem::query()->whereNull('parent_id')->pluck('label', 'id'))
                        ->searchable()
                        ->nullable(),
                    Select::make('location')->options([
                        'header' => 'Header',
                        'footer' => 'Footer',
                    ])->default('header')->required(),
                    Toggle::make('is_active')->default(true),
                    TextInput::make('sort_order')->numeric()->default(0),
                ]),
            ]);
    }
}
