<?php

namespace App\Filament\Resources\NewsletterSubscribers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsletterSubscriberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subscriber')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')->email()->required()->maxLength(190),
                        TextInput::make('name')->maxLength(120),
                        Select::make('status')
                            ->options([
                                'subscribed' => 'Subscribed',
                                'unsubscribed' => 'Unsubscribed',
                            ])
                            ->required()
                            ->default('subscribed'),
                        TextInput::make('source')->maxLength(60)->default('admin'),
                        DateTimePicker::make('subscribed_at'),
                        DateTimePicker::make('unsubscribed_at'),
                    ]),
            ]);
    }
}
