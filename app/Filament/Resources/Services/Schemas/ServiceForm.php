<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Filament\Forms\SeoForm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Service')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Content')
                            ->schema([
                                Section::make()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($state, callable $set, ?string $operation) => $operation === 'create' ? $set('slug', Str::slug((string) $state)) : null),
                                        TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                        TextInput::make('subtitle'),
                                        TextInput::make('icon')->helperText('Font Awesome class e.g. fa-solid fa-laptop-code'),
                                        Textarea::make('short_description')->rows(3)->columnSpanFull(),
                                        RichEditor::make('description')->columnSpanFull(),
                                        FileUpload::make('image')->image()->directory('services')->disk('public'),
                                        FileUpload::make('banner_image')
                                            ->label('Page Banner / Cover')
                                            ->image()
                                            ->directory('services/banners')
                                            ->disk('public')
                                            ->helperText('Empty = Site Settings default banner'),
                                        Repeater::make('features')
                                            ->simple(TextInput::make('feature'))
                                            ->columnSpanFull(),
                                        Toggle::make('is_featured'),
                                        Toggle::make('is_published')->default(true),
                                        TextInput::make('sort_order')->numeric()->default(0),
                                    ]),
                            ]),
                        Tab::make('SEO')
                            ->schema([
                                SeoForm::section(),
                            ]),
                    ]),
            ]);
    }
}
