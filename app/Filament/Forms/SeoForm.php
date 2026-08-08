<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class SeoForm
{
    public static function section(): Section
    {
        return Section::make('SEO')
            ->description('Meta tags, Open Graph, Twitter Card, robots & schema')
            ->collapsed()
            ->schema([
                TextInput::make('meta_title')
                    ->label('Meta Title')
                    ->maxLength(70)
                    ->helperText('Recommended: 50–60 characters'),
                Textarea::make('meta_description')
                    ->label('Meta Description')
                    ->rows(3)
                    ->maxLength(160)
                    ->helperText('Recommended: 150–160 characters'),
                TextInput::make('meta_keywords')
                    ->label('Meta Keywords')
                    ->helperText('Comma-separated keywords'),
                TextInput::make('meta_author')->label('Meta Author'),
                TextInput::make('canonical_url')->label('Canonical URL')->url(),
                Select::make('robots')
                    ->options([
                        'index, follow' => 'Index, Follow',
                        'noindex, follow' => 'NoIndex, Follow',
                        'index, nofollow' => 'Index, NoFollow',
                        'noindex, nofollow' => 'NoIndex, NoFollow',
                    ])
                    ->default('index, follow'),
                TextInput::make('og_title')->label('OG Title'),
                Textarea::make('og_description')->label('OG Description')->rows(2),
                FileUpload::make('og_image')
                    ->label('OG Image')
                    ->image()
                    ->directory('seo')
                    ->disk('public'),
                TextInput::make('og_type')->label('OG Type')->default('website'),
                TextInput::make('twitter_title')->label('Twitter Title'),
                Textarea::make('twitter_description')->label('Twitter Description')->rows(2),
                FileUpload::make('twitter_image')
                    ->label('Twitter Image')
                    ->image()
                    ->directory('seo')
                    ->disk('public'),
                Select::make('twitter_card')
                    ->label('Twitter Card')
                    ->options([
                        'summary' => 'Summary',
                        'summary_large_image' => 'Summary Large Image',
                    ])
                    ->default('summary_large_image'),
                Textarea::make('schema_markup')
                    ->label('Schema Markup (JSON-LD)')
                    ->rows(6)
                    ->helperText('Paste JSON-LD structured data without script tags'),
            ])
            ->columns(2);
    }
}
