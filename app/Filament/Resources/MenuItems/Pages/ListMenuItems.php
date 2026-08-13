<?php

namespace App\Filament\Resources\MenuItems\Pages;

use App\Filament\Resources\MenuItems\MenuItemResource;
use App\Models\MenuItem;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMenuItems extends ListRecords
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        $location = match ($this->activeTab) {
            'header' => 'header',
            'footer' => 'footer',
            'footer_bottom' => 'footer_bottom',
            default => 'footer',
        };

        return [
            CreateAction::make()
                ->fillForm([
                    'location' => $location,
                    'is_active' => true,
                    'sort_order' => 0,
                ]),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->badge(fn (): int => MenuItem::query()->count()),
            'header' => Tab::make('Header')
                ->badge(fn (): int => MenuItem::query()->where('location', 'header')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('location', 'header')),
            'footer' => Tab::make('Quick Links')
                ->badge(fn (): int => MenuItem::query()->where('location', 'footer')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('location', 'footer')),
            'footer_bottom' => Tab::make('Bottom Bar')
                ->badge(fn (): int => MenuItem::query()->where('location', 'footer_bottom')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('location', 'footer_bottom')),
        ];
    }
}
