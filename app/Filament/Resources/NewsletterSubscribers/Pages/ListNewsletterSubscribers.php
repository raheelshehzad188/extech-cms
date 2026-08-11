<?php

namespace App\Filament\Resources\NewsletterSubscribers\Pages;

use App\Filament\Resources\NewsletterSubscribers\NewsletterSubscriberResource;
use App\Models\NewsletterSubscriber;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListNewsletterSubscribers extends ListRecords
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportCsv')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->action(fn (): StreamedResponse => $this->exportCsv()),
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'subscribed' => Tab::make('Subscribed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'subscribed')),
            'unsubscribed' => Tab::make('Unsubscribed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'unsubscribed')),
        ];
    }

    protected function exportCsv(): StreamedResponse
    {
        $fileName = 'newsletter-subscribers-'.now()->format('Y-m-d-His').'.csv';

        return Response::streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Email', 'Name', 'Status', 'Source', 'Subscribed At', 'Unsubscribed At', 'IP', 'Created At']);

            NewsletterSubscriber::query()
                ->orderByDesc('id')
                ->chunk(200, function ($subscribers) use ($handle): void {
                    foreach ($subscribers as $subscriber) {
                        fputcsv($handle, [
                            $subscriber->id,
                            $subscriber->email,
                            $subscriber->name,
                            $subscriber->status,
                            $subscriber->source,
                            optional($subscriber->subscribed_at)?->toDateTimeString(),
                            optional($subscriber->unsubscribed_at)?->toDateTimeString(),
                            $subscriber->ip_address,
                            optional($subscriber->created_at)?->toDateTimeString(),
                        ]);
                    }
                });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
