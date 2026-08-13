<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use App\Models\MenuItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Menu Item')
                    ->columns(2)
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(120),
                        Select::make('location')
                            ->options([
                                'header' => 'Header',
                                'footer' => 'Footer Quick Links',
                                'footer_bottom' => 'Footer Bottom Bar',
                            ])
                            ->default('footer_bottom')
                            ->required()
                            ->live(),
                        Select::make('route_name')
                            ->label('Page')
                            ->options([
                                'home' => 'Home',
                                'about' => 'About',
                                'services.index' => 'Services',
                                'team.index' => 'Team',
                                'projects.index' => 'Projects',
                                'blog.index' => 'Blog',
                                'faq' => 'FAQs',
                                'contact' => 'Contact',
                                'quote' => 'Get A Quote',
                            ])
                            ->searchable()
                            ->nullable()
                            ->helperText('Pick a site page, or leave empty and use a custom URL.'),
                        TextInput::make('url')
                            ->label('Custom URL')
                            ->placeholder('/about or https://...')
                            ->helperText('Used only if Page is empty.'),
                        Select::make('parent_id')
                            ->label('Parent (header dropdown)')
                            ->options(fn (Get $get) => MenuItem::query()
                                ->whereNull('parent_id')
                                ->where('location', $get('location') ?: 'header')
                                ->pluck('label', 'id'))
                            ->searchable()
                            ->nullable()
                            ->visible(fn (Get $get): bool => $get('location') === 'header'),
                        Toggle::make('is_active')->default(true),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower number shows first. You can also drag rows in the list.'),
                    ]),
            ]);
    }
}
