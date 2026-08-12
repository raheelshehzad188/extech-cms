<?php

namespace App\Filament\Resources\PlanSubscriptions\Tables;

use App\Models\PlanSubscription;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PlanSubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->copyable(),
                TextColumn::make('phone')->label('Contact')->searchable()->toggleable(),
                TextColumn::make('whatsapp')->label('WhatsApp')->searchable()->toggleable(),
                TextColumn::make('business_name')->label('Business')->searchable()->toggleable(),
                TextColumn::make('website')->label('Website')->toggleable()->limit(30),
                TextColumn::make('country')->searchable()->toggleable(),
                TextColumn::make('address')->limit(40)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('plan_name')->label('Plan')->searchable()->sortable(),
                TextColumn::make('plan_price')->label('Plan Price')->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed', 'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'warning',
                    })
                    ->sortable(),
                TextColumn::make('created_at')->label('Requested')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ]),
            ])
            ->recordActions([
                Action::make('confirm')
                    ->label('Confirm')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (PlanSubscription $record): bool => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(function (PlanSubscription $record): void {
                        $record->markConfirmed();

                        Notification::make()
                            ->title('Request confirmed')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
