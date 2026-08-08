<?php

namespace App\Filament\Pages;

use App\Filament\Forms\SeoForm;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManageSiteSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'Site Settings';

    protected static ?string $slug = 'site-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::current();
        $this->form->fill($settings->attributesToArray());
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->operation('edit')
            ->model(SiteSetting::current())
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')
                    ->persistTabInQueryString()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                Section::make('Brand')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('site_name')->required()->maxLength(120),
                                        TextInput::make('tagline')->maxLength(255),
                                        TextInput::make('preloader_text')->maxLength(20)->helperText('Letters shown in preloader'),
                                        FileUpload::make('logo')->image()->directory('brand')->disk('public'),
                                        FileUpload::make('logo_white')->image()->directory('brand')->disk('public'),
                                        FileUpload::make('favicon')->image()->directory('brand')->disk('public'),
                                        FileUpload::make('default_banner')
                                            ->label('Default Page Banner / Cover')
                                            ->image()
                                            ->directory('banners')
                                            ->disk('public')
                                            ->helperText('Har page pe ye banner dikhega jab individual banner set na ho')
                                            ->columnSpanFull(),
                                    ]),
                                Section::make('Home Page Template')
                                    ->schema([
                                        Select::make('home_template')
                                            ->label('Active Home Page')
                                            ->options([
                                                'home-1' => 'Home 01 (Classic)',
                                                'home-2' => 'Home 02 (Modern)',
                                                'home-3' => 'Home 03 (Minimal)',
                                            ])
                                            ->required()
                                            ->native(false)
                                            ->helperText('Admin se choose karein kaunsa home page live dikhe'),
                                    ]),
                            ]),
                        Tab::make('Colors & Fonts')
                            ->schema([
                                Section::make('Color Scheme')
                                    ->columns(3)
                                    ->schema([
                                        ColorPicker::make('color_theme')->label('Primary Theme'),
                                        ColorPicker::make('color_theme2')->label('Secondary Theme'),
                                        ColorPicker::make('color_theme3')->label('Accent'),
                                        ColorPicker::make('color_header')->label('Header'),
                                        ColorPicker::make('color_title')->label('Titles'),
                                        ColorPicker::make('color_text')->label('Body Text'),
                                        ColorPicker::make('color_bg')->label('Background Soft'),
                                        ColorPicker::make('color_body')->label('Body Background'),
                                        ColorPicker::make('color_border')->label('Border'),
                                    ]),
                                Section::make('Typography')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('font_title')
                                            ->label('Title Font Family')
                                            ->searchable()
                                            ->options(self::fontOptions())
                                            ->required(),
                                        Select::make('font_body')
                                            ->label('Body Font Family')
                                            ->searchable()
                                            ->options(self::fontOptions())
                                            ->required(),
                                    ]),
                            ]),
                        Tab::make('Contact & Social')
                            ->schema([
                                Section::make('Contact Info')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('email')->email(),
                                        TextInput::make('phone')->tel(),
                                        TextInput::make('address')->columnSpanFull(),
                                        TextInput::make('working_hours'),
                                        TextInput::make('map_embed_url')->label('Google Map Embed URL')->columnSpanFull(),
                                    ]),
                                Section::make('Social Links')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('facebook')->url(),
                                        TextInput::make('twitter')->url(),
                                        TextInput::make('instagram')->url(),
                                        TextInput::make('linkedin')->url(),
                                        TextInput::make('youtube')->url(),
                                    ]),
                                Section::make('Header / Footer')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('header_cta_text'),
                                        TextInput::make('header_cta_url'),
                                        Textarea::make('offcanvas_text')->rows(3)->columnSpanFull(),
                                        Textarea::make('footer_about')->rows(3)->columnSpanFull(),
                                        TextInput::make('footer_copyright')->columnSpanFull(),
                                    ]),
                            ]),
                        Tab::make('Home 1 Content')
                            ->schema(self::homeContentFields('home_1_content')),
                        Tab::make('Home 2 Content')
                            ->schema(self::homeContentFields('home_2_content')),
                        Tab::make('Home 3 Content')
                            ->schema(self::homeContentFields('home_3_content')),
                        Tab::make('Global SEO')
                            ->schema([
                                SeoForm::section(),
                                Section::make('Custom Code')
                                    ->schema([
                                        Textarea::make('custom_head_code')->label('Custom Head Code')->rows(4),
                                        Textarea::make('custom_body_code')->label('Custom Body Code')->rows(4),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected static function homeContentFields(string $prefix): array
    {
        return [
            Section::make('Hero Section')
                ->columns(2)
                ->schema([
                    TextInput::make("{$prefix}.hero_subtitle")->label('Subtitle'),
                    TextInput::make("{$prefix}.hero_title")->label('Title')->columnSpanFull(),
                    TextInput::make("{$prefix}.hero_cta_text")->label('CTA Text'),
                    TextInput::make("{$prefix}.hero_cta_url")->label('CTA URL'),
                    FileUpload::make("{$prefix}.hero_image")->label('Hero Image')->image()->directory('home')->disk('public')->columnSpanFull(),
                    Repeater::make("{$prefix}.hero_checklist")
                        ->label('Checklist Items')
                        ->simple(TextInput::make('item')->required())
                        ->columnSpanFull()
                        ->defaultItems(0),
                ]),
            Section::make('About / Intro')
                ->columns(2)
                ->schema([
                    TextInput::make("{$prefix}.about_subtitle")->label('Subtitle'),
                    TextInput::make("{$prefix}.about_title")->label('Title')->columnSpanFull(),
                    Textarea::make("{$prefix}.about_text")->label('Text')->rows(4)->columnSpanFull(),
                    TextInput::make("{$prefix}.about_cta_text")->label('CTA Text'),
                    TextInput::make("{$prefix}.about_cta_url")->label('CTA URL'),
                ]),
            Section::make('Services Block')
                ->columns(2)
                ->schema([
                    TextInput::make("{$prefix}.services_subtitle")->label('Subtitle'),
                    TextInput::make("{$prefix}.services_title")->label('Title')->columnSpanFull(),
                    Textarea::make("{$prefix}.services_text")->label('Text')->rows(3)->columnSpanFull(),
                ]),
            Section::make('CTA / Extra Texts')
                ->columns(2)
                ->schema([
                    TextInput::make("{$prefix}.cta_title")->label('CTA Title')->columnSpanFull(),
                    Textarea::make("{$prefix}.cta_text")->label('CTA Text')->rows(2)->columnSpanFull(),
                    TextInput::make("{$prefix}.cta_button_text")->label('Button Text'),
                    TextInput::make("{$prefix}.cta_button_url")->label('Button URL'),
                    TextInput::make("{$prefix}.section_extra_title")->label('Extra Section Title')->columnSpanFull(),
                    Textarea::make("{$prefix}.section_extra_text")->label('Extra Section Text')->rows(3)->columnSpanFull(),
                ]),
        ];
    }

    /**
     * @return array<string, string>
     */
    protected static function fontOptions(): array
    {
        $fonts = [
            'Rajdhani',
            'Plus Jakarta Sans',
            'Inter',
            'Roboto',
            'Open Sans',
            'Poppins',
            'Montserrat',
            'Lato',
            'Nunito',
            'Oswald',
            'Raleway',
            'Merriweather',
            'Playfair Display',
            'Source Sans 3',
            'Work Sans',
            'DM Sans',
            'Outfit',
            'Manrope',
            'Space Grotesk',
            'Sora',
        ];

        return array_combine($fonts, $fonts);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = SiteSetting::current();
        $settings->fill($data);
        $settings->save();
        SiteSetting::flushCache();

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
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
                                ->label('Save settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ]);
    }
}
