<?php

namespace App\Filament\Resources\PlanSubscriptions\Pages;

use App\Filament\Resources\PlanSubscriptions\PlanSubscriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPlanSubscription extends EditRecord
{
    protected static string $resource = PlanSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['payment_type'] = 'one_time';
        $data['email'] = strtolower(trim($data['email']));

        return $data;
    }
}
