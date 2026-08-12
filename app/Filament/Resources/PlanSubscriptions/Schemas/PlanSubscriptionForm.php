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
                Section::make('Plan')
                    ->columns(2)
                    ->schema([
                        Select::make('pricing_plan_id')
                            ->label('Pricing Plan')
                            ->options(fn () => PricingPlan::query()->orderBy('sort_order')->pluck('name', 'id'))
                            ->searchable()
                            ->nullable(),
                        TextInput::make('plan_name')->required()->maxLength(160),
                        TextInput::make('plan_price')->label('Plan Price')->maxLength(80),
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
                Section::make('Client Request')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->required()->maxLength(120),
                        TextInput::make('email')->email()->required()->maxLength(190),
                        TextInput::make('phone')->label('Contact')->required()->maxLength(40),
                        TextInput::make('whatsapp')->label('WhatsApp')->maxLength(40),
                        TextInput::make('business_name')->label('Business Name')->maxLength(160),
                        TextInput::make('website')->label('Website')->maxLength(255),
                        TextInput::make('country')->maxLength(120),
                        Textarea::make('address')->rows(3)->columnSpanFull(),
                        Textarea::make('message')->label('Notes')->rows(3)->columnSpanFull(),
                    ]),
            ]);
    }
}
