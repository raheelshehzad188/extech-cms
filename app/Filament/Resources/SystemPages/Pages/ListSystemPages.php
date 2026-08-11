<?php

namespace App\Filament\Resources\SystemPages\Pages;

use App\Filament\Resources\SystemPages\SystemPageResource;
use App\Support\SystemPages;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListSystemPages extends ListRecords
{
    protected static string $resource = SystemPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('ensureSystemPages')
                ->label('Create Missing Pages')
                ->icon('heroicon-o-sparkles')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Create System Pages')
                ->modalDescription('About, Contact, Services, Team, Projects, Blog, FAQ, Quote — missing pages create hongi. Existing data overwrite nahi hoga.')
                ->action(function (): void {
                    $pages = SystemPages::ensure();

                    Notification::make()
                        ->title('System pages ready ('.$pages->count().')')
                        ->success()
                        ->send();

                    $this->redirect(static::getUrl());
                }),
        ];
    }
}
