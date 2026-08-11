<?php

namespace App\Filament\Resources\PlanSubscriptions\Pages;

use App\Filament\Resources\PlanSubscriptions\PlanSubscriptionResource;
use App\Models\PricingPlan;
use Filament\Resources\Pages\CreateRecord;

class CreatePlanSubscription extends CreateRecord
{
    protected static string $resource = PlanSubscriptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['payment_type'] = 'one_time';
        $data['email'] = strtolower(trim($data['email']));

        if (empty($data['plan_name']) && ! empty($data['pricing_plan_id'])) {
            $plan = PricingPlan::query()->find($data['pricing_plan_id']);
            if ($plan) {
                $data['plan_name'] = $plan->name;
                $data['plan_price'] = $data['plan_price'] ?: $plan->displayPrice();
            }
        }

        return $data;
    }
}
