<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Forms\SeoForm;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Post')
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
                                    TextInput::make('category'),
                                    TextInput::make('author_name'),
                                    DateTimePicker::make('published_at'),
                                    Textarea::make('excerpt')->rows(3)->columnSpanFull(),
                                    RichEditor::make('content')->columnSpanFull(),
                                    FileUpload::make('image')->image()->directory('posts')->disk('public'),
                                    FileUpload::make('banner_image')
                                        ->label('Page Banner / Cover')
                                        ->image()
                                        ->directory('posts/banners')
                                        ->disk('public')
                                        ->helperText('Empty = Site Settings default banner'),
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
