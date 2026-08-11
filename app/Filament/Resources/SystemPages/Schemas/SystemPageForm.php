<?php

namespace App\Filament\Resources\SystemPages\Schemas;

use App\Filament\Forms\SeoForm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SystemPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('System Page')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Page')
                            ->schema([
                                Section::make('Page Details')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('title')->required()->maxLength(160),
                                        TextInput::make('slug')->disabled()->dehydrated(),
                                        TextInput::make('breadcrumb_title')->label('Breadcrumb Title')->maxLength(160),
                                        TextInput::make('subtitle')->maxLength(255),
                                        RichEditor::make('content')
                                            ->label('Page Content')
                                            ->columnSpanFull()
                                            ->helperText('Shows on the frontend About (and other system) pages'),
                                        FileUpload::make('banner_image')
                                            ->label('Top Banner Image')
                                            ->image()
                                            ->directory('pages/banners')
                                            ->disk('public')
                                            ->helperText('Empty = Site Settings default banner')
                                            ->columnSpanFull(),
                                        Toggle::make('is_published')->default(true),
                                    ]),
                            ]),
                        Tab::make('SEO')
                            ->schema([
                                SeoForm::section()->collapsed(false),
                            ]),
                    ]),
            ]);
    }
}
