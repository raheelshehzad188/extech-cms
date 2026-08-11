<?php

namespace App\Filament\Resources\NewsletterSubscribers\Pages;

use App\Filament\Resources\NewsletterSubscribers\NewsletterSubscriberResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsletterSubscriber extends CreateRecord
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['email'] = strtolower(trim($data['email']));
        $data['source'] = $data['source'] ?: 'admin';

        if (($data['status'] ?? 'subscribed') === 'subscribed' && empty($data['subscribed_at'])) {
            $data['subscribed_at'] = now();
        }

        return $data;
    }
}
