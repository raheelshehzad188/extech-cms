<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Support\ContactDefaults;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('fillContactDefaults')
                ->label('Fill Default Data')
                ->icon('heroicon-o-sparkles')
                ->color('warning')
                ->visible(fn (): bool => ($this->record->slug ?? '') === 'contact' || ($this->record->template ?? '') === 'contact')
                ->requiresConfirmation()
                ->modalHeading('Fill Contact Default Data')
                ->modalDescription('Ye contact page + phone/email/address/map ko template defaults se fill kar dega. Manual DB change ki zarurat nahi.')
                ->action(function (): void {
                    $page = ContactDefaults::apply(overwriteSiteSettings: true);
                    $this->record = $page;
                    $this->fillForm();

                    Notification::make()
                        ->title('Contact defaults applied')
                        ->success()
                        ->send();
                }),
            DeleteAction::make(),
        ];
    }
}
