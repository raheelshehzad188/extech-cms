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
                        TextInput::make('monthly_price')->label('Monthly Price')->placeholder('$49')->required(),
                        TextInput::make('yearly_price')->label('Yearly Price')->placeholder('$399')->required(),
                        TextInput::make('monthly_suffix')->default('/ Month'),
                        TextInput::make('yearly_suffix')->default('/ Year'),
                        FileUpload::make('icon')->image()->directory('pricing')->disk('public'),
                        TextInput::make('button_text')->default('Get Started Now'),
                        TextInput::make('button_url')->default('/contact')->columnSpanFull(),
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
