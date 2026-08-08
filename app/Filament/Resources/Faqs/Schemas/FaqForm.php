<?php

namespace App\Filament\Resources\Faqs\Schemas;

use App\Filament\Forms\SeoForm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('FAQ')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Content')
                            ->schema([
                                Section::make()->columns(2)->schema([
                                    TextInput::make('question')->required()->columnSpanFull(),
                                    Textarea::make('answer')->required()->rows(5)->columnSpanFull(),
                                    TextInput::make('category'),
                                    FileUpload::make('banner_image')
                                        ->label('Page Banner / Cover')
                                        ->image()
                                        ->directory('faqs/banners')
                                        ->disk('public')
                                        ->helperText('FAQ listing page banner (optional). Empty = Site Settings default.'),
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
