<?php

namespace App\Filament\Resources\NewsletterSubscribers\Tables;

use App\Models\NewsletterSubscriber;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class NewsletterSubscribersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->searchable()->sortable()->copyable(),
                TextColumn::make('name')->searchable()->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'subscribed' ? 'success' : 'gray')
                    ->sortable(),
                TextColumn::make('source')->badge()->toggleable(),
                TextColumn::make('ip_address')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('subscribed_at')->dateTime()->sortable(),
                TextColumn::make('unsubscribed_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('subscribed_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'subscribed' => 'Subscribed',
                    'unsubscribed' => 'Unsubscribed',
                ]),
                SelectFilter::make('source'),
            ])
            ->recordActions([
                Action::make('unsubscribe')
                    ->label('Unsubscribe')
                    ->icon('heroicon-o-no-symbol')
                    ->color('warning')
                    ->visible(fn (NewsletterSubscriber $record): bool => $record->isSubscribed())
                    ->requiresConfirmation()
                    ->action(function (NewsletterSubscriber $record): void {
                        $record->markUnsubscribed();

                        Notification::make()
                            ->title('Subscriber unsubscribed')
                            ->success()
                            ->send();
                    }),
                Action::make('resubscribe')
                    ->label('Resubscribe')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (NewsletterSubscriber $record): bool => ! $record->isSubscribed())
                    ->requiresConfirmation()
                    ->action(function (NewsletterSubscriber $record): void {
                        $record->markSubscribed('admin');

                        Notification::make()
                            ->title('Subscriber resubscribed')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('markUnsubscribed')
                        ->label('Mark unsubscribed')
                        ->icon('heroicon-o-no-symbol')
                        ->requiresConfirmation()
                        ->action(function (Collection $records): void {
                            $records->each->markUnsubscribed();
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
