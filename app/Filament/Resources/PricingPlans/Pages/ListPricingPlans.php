<?php

namespace App\Filament\Resources\PricingPlans\Pages;

use App\Filament\Resources\PricingPlans\PricingPlanResource;
use App\Support\PricingDefaults;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListPricingPlans extends ListRecords
{
    protected static string $resource = PricingPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('fillPricingDefaults')
                ->label('Fill Default Data')
                ->icon('heroicon-o-sparkles')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Fill Pricing Default Data')
                ->modalDescription('Purane plans replace ho kar 3 default pricing plans + section titles set ho jayenge.')
                ->action(function (): void {
                    $plans = PricingDefaults::apply(replaceExisting: true);

                    Notification::make()
                        ->title('Pricing defaults applied ('.$plans->count().' plans)')
                        ->success()
                        ->send();

                    $this->redirect(static::getUrl());
                }),
            CreateAction::make(),
        ];
    }
}
