<?php

namespace App\Filament\Resources\PlanSubscriptions\Schemas;

use App\Models\PricingPlan;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PlanSubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Package')
                    ->columns(2)
                    ->schema([
                        Select::make('pricing_plan_id')
                            ->label('Pricing Plan')
                            ->options(fn () => PricingPlan::query()->orderBy('sort_order')->pluck('name', 'id'))
                            ->searchable()
                            ->nullable(),
                        TextInput::make('plan_name')->required()->maxLength(160),
                        TextInput::make('plan_price')->label('One-Time Price')->maxLength(60),
                        TextInput::make('payment_type')->default('one_time')->disabled()->dehydrated(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('pending'),
                        DateTimePicker::make('confirmed_at'),
                    ]),
                Section::make('Customer')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->required()->maxLength(120),
                        TextInput::make('email')->email()->required()->maxLength(190),
                        TextInput::make('phone')->maxLength(40),
                        TextInput::make('company')->maxLength(160),
                        Textarea::make('message')->rows(4)->columnSpanFull(),
                    ]),
            ]);
    }
}
