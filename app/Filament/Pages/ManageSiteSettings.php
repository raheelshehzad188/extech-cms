<?php

namespace App\Filament\Pages;

use App\Filament\Forms\SeoForm;
use App\Models\SiteSetting;
use App\Support\BrandDefaults;
use App\Support\Home1Defaults;
use App\Support\PricingDefaults;
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

    protected function getHeaderActions(): array
    {
        return [
            Action::make('fillHome1Defaults')
                ->label('Set Default Data (Home 1)')
                ->icon('heroicon-o-sparkles')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Home 01 — Set Default Data')
                ->modalDescription('DB manually edit ki zarurat nahi. Texts, images, brands fill ho jayenge aur Home 01 active ho jayegi.')
                ->action(fn () => $this->fillHome1DefaultData()),
        ];
    }

    public function fillHome1DefaultData(): void
    {
        Home1Defaults::apply(switchTemplate: true);
        BrandDefaults::apply(replaceExisting: true);
        PricingDefaults::apply(replaceExisting: false);

        $this->form->fill(SiteSetting::current()->attributesToArray());

        Notification::make()
            ->title('Home 1 default data set')
            ->body('Images + texts filled. Template switched to Home 01.')
            ->success()
            ->send();
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
                                        TextInput::make('preloader_text')->maxLength(20)->helperText('Letters shown when GIF not uploaded'),
                                        FileUpload::make('preloader_gif')
                                            ->label('Preloader GIF / Image')
                                            ->image()
                                            ->acceptedFileTypes(['image/gif', 'image/png', 'image/webp', 'image/jpeg', 'image/svg+xml'])
                                            ->directory('preloaders')
                                            ->disk('public')
                                            ->helperText('Upload GIF/PNG — ye preloader letters ki jagah dikhega'),
                                        TextInput::make('preloader_loading_text')
                                            ->label('Preloader Loading Text')
                                            ->default('Loading'),
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
                                            ->helperText('Home 01 fill: open “Home 1 Content” tab → click Set Default Data (DB manually edit ki zarurat nahi)'),
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
                                        TextInput::make('locations_heading')
                                            ->label('Locations Heading')
                                            ->placeholder('Locations')
                                            ->helperText('Footer locations section title. Manage offices from Website → Locations.'),
                                        TextInput::make('locations_watermark')
                                            ->label('Locations Watermark')
                                            ->placeholder('SALES OFFICES'),
                                    ]),
                            ]),
                        Tab::make('Home 1 Content')
                            ->schema([
                                Section::make('Quick Setup')
                                    ->description('DB change ki zarurat nahi. Ek click pe Home 01 ka pura dummy content + images set ho jayega.')
                                    ->schema([
                                        Actions::make([
                                            Action::make('setHome1DefaultsInTab')
                                                ->label('Set Default Data')
                                                ->icon('heroicon-o-sparkles')
                                                ->color('warning')
                                                ->requiresConfirmation()
                                                ->modalHeading('Home 01 — Set Default Data?')
                                                ->modalDescription('Saari Home 1 texts/images fill hongi, brands update hongi, aur active template Home 01 ban jayegi.')
                                                ->action(fn () => $this->fillHome1DefaultData()),
                                        ]),
                                    ]),
                                ...self::homeContentFields('home_1_content'),
                            ]),
                        Tab::make('Home 2 Content')
                            ->schema(self::homeContentFields('home_2_content')),
                        Tab::make('Home 3 Content')
                            ->schema(self::home3ContentFields()),
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
    protected static function home3ContentFields(): array
    {
        $p = 'home_3_content';

        return [
            Section::make('Hero Slider Slides')
                ->schema([
                    Repeater::make("{$p}.hero_slides")
                        ->label('Slides')
                        ->collapsible()
                        ->defaultItems(0)
                        ->schema([
                            FileUpload::make('image')->label('Background Image')->image()->directory('home/slides')->disk('public')->required(),
                            TextInput::make('subtitle')->default('best it company'),
                            TextInput::make('title')->required()->columnSpanFull(),
                            Textarea::make('text')->rows(2)->columnSpanFull(),
                            TextInput::make('btn1_text')->label('Button 1 Text')->default('Explore More'),
                            TextInput::make('btn1_url')->label('Button 1 URL')->default('/about'),
                            TextInput::make('btn2_text')->label('Button 2 Text')->default('Contact Us'),
                            TextInput::make('btn2_url')->label('Button 2 URL')->default('/contact'),
                        ])
                        ->columns(2),
                ]),
            Section::make('About Section')
                ->columns(2)
                ->schema([
                    TextInput::make("{$p}.about_subtitle")->default('ABOUT EXTECH'),
                    TextInput::make("{$p}.about_title")->columnSpanFull(),
                    Textarea::make("{$p}.about_text")->rows(3)->columnSpanFull(),
                    FileUpload::make("{$p}.about_image")->image()->directory('home')->disk('public'),
                    TextInput::make("{$p}.about_video_url")->label('Video URL'),
                    TextInput::make("{$p}.about_clients_count")->label('Clients Count')->default('6,561'),
                    TextInput::make("{$p}.about_clients_label")->label('Clients Label')->default('Satisfied Clients'),
                    TextInput::make("{$p}.about_phone")->label('Call Us Number'),
                    TextInput::make("{$p}.about_cta_text")->default('Explore More'),
                    TextInput::make("{$p}.about_cta_url")->default('/about'),
                    Repeater::make("{$p}.about_checklist")
                        ->simple(TextInput::make('item'))
                        ->columnSpanFull(),
                ]),
            Section::make('Brand Strip')
                ->schema([
                    TextInput::make("{$p}.brand_text")->default('1k + Brands Trust Us'),
                ])
                ->description('Brand logos manage karein: Website → Brands'),
            Section::make('Services Block')
                ->columns(2)
                ->schema([
                    TextInput::make("{$p}.services_subtitle")->default('What We Do'),
                    TextInput::make("{$p}.services_title")->columnSpanFull(),
                    TextInput::make("{$p}.services_cta_text")->default('See all Services'),
                    TextInput::make("{$p}.cta_title")->label('Services CTA Title')->columnSpanFull(),
                    TextInput::make("{$p}.cta_phone")->label('CTA Phone'),
                    FileUpload::make("{$p}.services_bg_image")
                        ->label('Services Section Background')
                        ->image()
                        ->directory('home/services')
                        ->disk('public')
                        ->helperText('Home 3 services section background (service-section-3)')
                        ->columnSpanFull(),
                ]),
            Section::make('Pricing Section')
                ->columns(2)
                ->schema([
                    TextInput::make("{$p}.pricing_subtitle")->default('Our Pricing'),
                    TextInput::make("{$p}.pricing_title")->default('Our Awesome Pricing Plans')->columnSpanFull(),
                ])
                ->description('One-time packages. Manage plans: Website → Pricing Plans'),
            Section::make('Work Process')
                ->schema([
                    TextInput::make("{$p}.process_subtitle")->default('How IT work'),
                    TextInput::make("{$p}.process_title")->default('Standard Work Process'),
                    Repeater::make("{$p}.process_steps")
                        ->schema([
                            TextInput::make('title')->required(),
                            Textarea::make('text')->rows(2),
                            FileUpload::make('icon')->image()->directory('home/process')->disk('public'),
                        ])
                        ->columns(2)
                        ->defaultItems(0),
                ]),
            Section::make('Achievements')
                ->columns(2)
                ->schema([
                    TextInput::make("{$p}.achievement_subtitle")->default('achievement'),
                    TextInput::make("{$p}.achievement_title")->columnSpanFull(),
                    Repeater::make("{$p}.achievements")
                        ->schema([
                            TextInput::make('number')->required(),
                            TextInput::make('label')->required(),
                            FileUpload::make('icon')->image()->directory('home/achievements')->disk('public'),
                        ])
                        ->columns(3)
                        ->columnSpanFull(),
                ]),
            Section::make('Projects Block')
                ->columns(2)
                ->schema([
                    TextInput::make("{$p}.projects_subtitle")->default('PROJECTS'),
                    TextInput::make("{$p}.projects_title")->columnSpanFull(),
                    TextInput::make("{$p}.projects_video_url"),
                    FileUpload::make("{$p}.projects_bg_image")
                        ->label('Projects Section Banner Background')
                        ->image()
                        ->directory('home/projects')
                        ->disk('public')
                        ->helperText('project-section-3 ka top/section background — empty = default testimonial/bg.jpg')
                        ->columnSpanFull(),
                ]),
            Section::make('Team / Testimonials / Blog titles')
                ->columns(2)
                ->schema([
                    TextInput::make("{$p}.team_subtitle")->default('Team Members'),
                    TextInput::make("{$p}.team_title")->columnSpanFull(),
                    FileUpload::make("{$p}.team_bg_image")
                        ->label('Team Section Banner Background')
                        ->image()
                        ->directory('home/team')
                        ->disk('public')
                        ->helperText('team-section-3 background — empty = default section background color')
                        ->columnSpanFull(),
                    TextInput::make("{$p}.testimonial_subtitle")->default('Testimonials'),
                    TextInput::make("{$p}.testimonial_title")->columnSpanFull(),
                    TextInput::make("{$p}.blog_subtitle")->default('Latest Blog'),
                    TextInput::make("{$p}.blog_title")->columnSpanFull(),
                    TextInput::make("{$p}.marque_items")->label('Marquee items (comma separated)')->columnSpanFull(),
                ]),
        ];
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
            Section::make('Pricing Section')
                ->columns(2)
                ->schema([
                    TextInput::make("{$prefix}.pricing_subtitle")->label('Subtitle')->default('Our Pricing'),
                    TextInput::make("{$prefix}.pricing_title")->label('Title')->default('Our Awesome Pricing Plans')->columnSpanFull(),
                ])
                ->description('One-time packages. Manage plans: Website → Pricing Plans'),
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
