<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use App\Support\BrandDefaults;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListBrands extends ListRecords
{
    protected static string $resource = BrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('fillBrandDefaults')
                ->label('Fill Default Data')
                ->icon('heroicon-o-sparkles')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Fill Brand Default Data')
                ->modalDescription('5 default brands logos ke sath create ho jayengi. Purane brands replace ho sakte hain. Live pe SQL se brands insert karne ki zarurat nahi.')
                ->action(function (): void {
                    $brands = BrandDefaults::apply(replaceExisting: true);

                    Notification::make()
                        ->title('Default brands created ('.$brands->count().') with images')
                        ->success()
                        ->send();

                    $this->redirect(static::getUrl());
                }),
            CreateAction::make(),
        ];
    }
}
