<?php

namespace App\Filament\Resources\MarketplaceProducts\Schemas;

use App\Filament\Forms\SeoForm;
use App\Models\MarketplaceCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MarketplaceProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product')
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
                                        Select::make('marketplace_category_id')
                                            ->label('Category')
                                            ->options(fn () => MarketplaceCategory::query()->orderBy('sort_order')->pluck('name', 'id'))
                                            ->searchable()
                                            ->nullable(),
                                        TextInput::make('sku')->label('SKU')->maxLength(80),
                                        TextInput::make('price')->numeric()->prefix('$')->required()->default(0),
                                        TextInput::make('sale_price')->numeric()->prefix('$')->helperText('Optional discounted price'),
                                        TextInput::make('price_suffix')->placeholder('One Time')->default('One Time'),
                                        Textarea::make('short_description')->rows(3)->columnSpanFull(),
                                        RichEditor::make('description')->columnSpanFull(),
                                        FileUpload::make('image')
                                            ->label('Card Image')
                                            ->image()
                                            ->directory('marketplace/products')
                                            ->disk('public'),
                                        FileUpload::make('banner_image')
                                            ->label('Page Banner')
                                            ->image()
                                            ->directory('marketplace/banners')
                                            ->disk('public'),
                                        FileUpload::make('gallery')
                                            ->label('Gallery')
                                            ->image()
                                            ->multiple()
                                            ->directory('marketplace/gallery')
                                            ->disk('public')
                                            ->columnSpanFull(),
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
                                SeoForm::section()->collapsed(false),
                            ]),
                    ]),
            ]);
    }
}
