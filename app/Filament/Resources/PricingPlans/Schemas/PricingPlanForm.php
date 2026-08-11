<?php

namespace App\Filament\Resources\PricingPlans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PricingPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Plan Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->required()->maxLength(120),
                        TextInput::make('monthly_price')
                            ->label('One-Time Package Price')
                            ->placeholder('$649')
                            ->required()
                            ->helperText('Single one-time charge (not monthly/yearly).'),
                        TextInput::make('monthly_suffix')
                            ->label('Price Label')
                            ->default('One Time')
                            ->helperText('Shown next to price, e.g. One Time'),
                        TextInput::make('yearly_price')
                            ->label('Legacy Yearly Price (unused)')
                            ->hidden()
                            ->dehydrated(false),
                        TextInput::make('yearly_suffix')->hidden()->dehydrated(false),
                        FileUpload::make('icon')->image()->directory('pricing')->disk('public'),
                        TextInput::make('button_text')->default('Buy Now'),
                        TextInput::make('button_url')
                            ->label('Custom Button URL (optional)')
                            ->helperText('Leave empty to open Plan Subscribe form.')
                            ->columnSpanFull(),
                        Select::make('card_style')
                            ->options([
                                'style1' => 'Default (style1)',
                                'style2' => 'Highlighted (style2)',
                            ])
                            ->default('style1')
                            ->native(false),
                        Toggle::make('is_highlighted')->label('Highlight this plan'),
                        Toggle::make('is_published')->default(true),
                        TextInput::make('sort_order')->numeric()->default(0),
                    ]),
                Section::make('Features')
                    ->schema([
                        Repeater::make('features')
                            ->schema([
                                TextInput::make('text')->required()->columnSpan(2),
                                Toggle::make('included')->label('Included')->default(true),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->reorderable()
                            ->collapsible(),
                    ]),
            ]);
    }
}
