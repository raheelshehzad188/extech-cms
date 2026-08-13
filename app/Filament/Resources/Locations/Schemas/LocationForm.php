<?php

namespace App\Filament\Resources\Locations\Schemas;

use App\Models\Location;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Location Details')
                    ->description('Maximum '.Location::MAX_COUNT.' locations. Footer columns adjust automatically (1 = full, 2 = two columns, up to 4).')
                    ->columns(2)
                    ->schema([
                        TextInput::make('country')
                            ->label('Country / City')
                            ->required()
                            ->maxLength(120)
                            ->placeholder('United States'),
                        TextInput::make('phone')
                            ->label('Phone')
                            ->tel()
                            ->maxLength(80)
                            ->placeholder('+1 234 567 890'),
                        TextInput::make('email')
                            ->email()
                            ->maxLength(160),
                        FileUpload::make('flag')
                            ->label('Flag')
                            ->image()
                            ->directory('locations/flags')
                            ->disk('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('3:2')
                            ->helperText('Shown on the left of the address in the footer.'),
                        Textarea::make('address')
                            ->label('Address')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_published')->default(true),
                        TextInput::make('sort_order')->numeric()->default(0),
                    ]),
            ]);
    }
}
