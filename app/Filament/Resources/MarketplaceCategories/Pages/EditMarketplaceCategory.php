<?php

namespace App\Filament\Resources\MarketplaceCategories\Pages;

use App\Filament\Resources\MarketplaceCategories\MarketplaceCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMarketplaceCategory extends EditRecord
{
    protected static string $resource = MarketplaceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
