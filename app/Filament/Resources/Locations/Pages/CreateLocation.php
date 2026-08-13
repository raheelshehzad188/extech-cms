<?php

namespace App\Filament\Resources\Locations\Pages;

use App\Filament\Resources\Locations\LocationResource;
use App\Models\Location;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateLocation extends CreateRecord
{
    protected static string $resource = LocationResource::class;

    public function mount(): void
    {
        if (! Location::canAddMore()) {
            Notification::make()
                ->title('Maximum '.Location::MAX_COUNT.' locations allowed')
                ->danger()
                ->send();

            $this->redirect(LocationResource::getUrl());

            return;
        }

        parent::mount();
    }
}
