<?php

namespace App\Filament\Resources\SystemPages\Pages;

use App\Filament\Resources\SystemPages\SystemPageResource;
use App\Support\SystemPages;
use Filament\Resources\Pages\EditRecord;

class EditSystemPage extends EditRecord
{
    protected static string $resource = SystemPageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Keep system slug locked.
        $data['slug'] = $this->record->slug;

        if (! array_key_exists($data['slug'], SystemPages::definitions())) {
            abort(403);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
