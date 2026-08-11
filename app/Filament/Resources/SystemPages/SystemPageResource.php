<?php

namespace App\Filament\Resources\SystemPages;

use App\Filament\Resources\SystemPages\Pages\EditSystemPage;
use App\Filament\Resources\SystemPages\Pages\ListSystemPages;
use App\Filament\Resources\SystemPages\Schemas\SystemPageForm;
use App\Filament\Resources\SystemPages\Tables\SystemPagesTable;
use App\Models\Page;
use App\Support\SystemPages;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class SystemPageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMagnifyingGlassCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Page SEO';

    protected static ?string $modelLabel = 'System Page';

    protected static ?string $pluralModelLabel = 'Page SEO';

    protected static ?string $slug = 'page-seo';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('slug', array_keys(SystemPages::definitions()));
    }

    public static function form(Schema $schema): Schema
    {
        return SystemPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SystemPagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSystemPages::route('/'),
            'edit' => EditSystemPage::route('/{record}/edit'),
        ];
    }
}
