<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Forms\SeoForm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Page')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Content')
                            ->schema([
                                Section::make()->columns(2)->schema([
                                    TextInput::make('title')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, callable $set, ?string $operation) => $operation === 'create' ? $set('slug', Str::slug((string) $state)) : null),
                                    TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                    TextInput::make('subtitle'),
                                    TextInput::make('breadcrumb_title'),
                                    Select::make('template')->options([
                                        'default' => 'Default',
                                        'about' => 'About',
                                        'contact' => 'Contact',
                                        'pricing' => 'Pricing',
                                    ])->default('default'),
                                    FileUpload::make('banner_image')
                                        ->label('Page Banner / Cover')
                                        ->image()
                                        ->directory('pages')
                                        ->disk('public')
                                        ->helperText('Empty = Site Settings default banner'),
                                    Textarea::make('content')->rows(8)->columnSpanFull(),
                                    Toggle::make('is_published')->default(true),
                                    TextInput::make('sort_order')->numeric()->default(0),
                                ]),
                            ]),
                        Tab::make('SEO')
                            ->schema([SeoForm::section()]),
                    ]),
            ]);
    }
}
