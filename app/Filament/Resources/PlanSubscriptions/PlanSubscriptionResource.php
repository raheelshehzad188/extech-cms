<?php

namespace App\Filament\Resources\PlanSubscriptions;

use App\Filament\Resources\PlanSubscriptions\Pages\CreatePlanSubscription;
use App\Filament\Resources\PlanSubscriptions\Pages\EditPlanSubscription;
use App\Filament\Resources\PlanSubscriptions\Pages\ListPlanSubscriptions;
use App\Filament\Resources\PlanSubscriptions\Schemas\PlanSubscriptionForm;
use App\Filament\Resources\PlanSubscriptions\Tables\PlanSubscriptionsTable;
use App\Models\PlanSubscription;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PlanSubscriptionResource extends Resource
{
    protected static ?string $model = PlanSubscription::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static string|UnitEnum|null $navigationGroup = 'Leads';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Plan Subscribe';

    protected static ?string $modelLabel = 'Plan Subscribe';

    protected static ?string $pluralModelLabel = 'Plan Subscribe';

    public static function form(Schema $schema): Schema
    {
        return PlanSubscriptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlanSubscriptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlanSubscriptions::route('/'),
            'create' => CreatePlanSubscription::route('/create'),
            'edit' => EditPlanSubscription::route('/{record}/edit'),
        ];
    }
}
