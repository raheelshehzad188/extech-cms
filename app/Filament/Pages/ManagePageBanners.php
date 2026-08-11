<?php

namespace App\Filament\Pages;

use App\Models\Page;
use App\Support\SystemPages;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page as FilamentPage;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManagePageBanners extends FilamentPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Page Banners (Quick)';

    protected static ?string $title = 'Page Banners';

    protected static ?string $slug = 'page-banners';

    protected static bool $shouldRegisterNavigation = false;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        SystemPages::ensure();

        $state = [];

        foreach (SystemPages::definitions() as $slug => $meta) {
            $page = Page::query()->where('slug', $slug)->first();
            $state["{$slug}_title"] = $page?->breadcrumb_title ?: ($page?->title ?: $meta['title']);
            $state["{$slug}_banner"] = $page?->banner_image;
        }

        $this->form->fill($state);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->operation('edit')
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        $sections = [];

        foreach (SystemPages::definitions() as $slug => $meta) {
            $sections[] = Section::make($meta['title'].' (/'.$slug.')')
                ->columns(2)
                ->schema([
                    TextInput::make("{$slug}_title")
                        ->label('Breadcrumb Title')
                        ->required(),
                    FileUpload::make("{$slug}_banner")
                        ->label('Top Banner Image')
                        ->image()
                        ->directory('pages/banners')
                        ->disk('public')
                        ->helperText('Empty = Site Settings → Default Page Banner')
                        ->columnSpanFull(),
                ]);
        }

        return $schema->components($sections);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach (array_keys(SystemPages::definitions()) as $slug) {
            $page = Page::query()->where('slug', $slug)->first();

            if (! $page) {
                continue;
            }

            $page->breadcrumb_title = $data["{$slug}_title"] ?? $page->breadcrumb_title;
            $page->banner_image = $data["{$slug}_banner"] ?? null;
            $page->save();
        }

        Notification::make()
            ->title('Page banners saved')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('ensurePages')
                ->label('Create Missing System Pages')
                ->icon('heroicon-o-sparkles')
                ->color('warning')
                ->requiresConfirmation()
                ->modalDescription('About, Contact, Services, Team, Projects, Blog, FAQ, Quote pages DB mein create hongi (existing overwrite nahi).')
                ->action(function (): void {
                    $pages = SystemPages::ensure();
                    $this->mount();

                    Notification::make()
                        ->title('System pages ready ('.$pages->count().')')
                        ->success()
                        ->send();
                }),
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save Page Banners')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ]);
    }
}
