<?php

namespace App\Filament\Resources\MarketplaceCategories\Pages;

use App\Filament\Resources\MarketplaceCategories\MarketplaceCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMarketplaceCategories extends ListRecords
{
    protected static string $resource = MarketplaceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
