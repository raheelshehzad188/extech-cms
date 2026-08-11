<?php

namespace App\Filament\Pages;

use App\Mail\SmtpTestMail;
use App\Models\MailSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Mail;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManageSmtpSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'SMTP Settings';

    protected static ?string $title = 'SMTP Settings';

    protected static ?string $slug = 'smtp-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        $settings = MailSetting::current();

        $this->form->fill([
            'is_enabled' => $settings->is_enabled,
            'mailer' => $settings->mailer ?: 'smtp',
            'host' => $settings->host,
            'port' => $settings->port ?: 587,
            'username' => $settings->username,
            'password' => '',
            'encryption' => $settings->encryption ?: 'tls',
            'from_address' => $settings->from_address,
            'from_name' => $settings->from_name,
            'test_to_email' => $settings->test_to_email ?: $settings->from_address,
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->operation('edit')
            ->model(MailSetting::current())
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('SMTP Configuration')
                    ->description('Save SMTP details here. These override .env mail settings when enabled.')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_enabled')
                            ->label('Enable SMTP from Admin')
                            ->helperText('When ON, website emails use these settings instead of .env')
                            ->columnSpanFull(),
                        Select::make('mailer')
                            ->label('Mailer')
                            ->options([
                                'smtp' => 'SMTP',
                                'log' => 'Log (testing only)',
                            ])
                            ->required()
                            ->native(false),
                        Select::make('encryption')
                            ->label('Encryption')
                            ->options([
                                'tls' => 'TLS (port 587)',
                                'ssl' => 'SSL (port 465)',
                                'none' => 'None',
                            ])
                            ->native(false)
                            ->required(),
                        TextInput::make('host')
                            ->label('SMTP Host')
                            ->placeholder('smtp.gmail.com / smtp.hostinger.com')
                            ->maxLength(190),
                        TextInput::make('port')
                            ->label('Port')
                            ->numeric()
                            ->default(587)
                            ->required(),
                        TextInput::make('username')
                            ->label('Username')
                            ->maxLength(190)
                            ->autocomplete(false),
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->helperText('Leave blank to keep the current saved password.')
                            ->autocomplete('new-password'),
                        TextInput::make('from_address')
                            ->label('From Email')
                            ->email()
                            ->required()
                            ->maxLength(190),
                        TextInput::make('from_name')
                            ->label('From Name')
                            ->maxLength(120),
                    ]),
                Section::make('Test Email')
                    ->description('Send a test mail after saving settings.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('test_to_email')
                            ->label('Send Test To')
                            ->email()
                            ->required()
                            ->maxLength(190)
                            ->helperText('Use your inbox to verify SMTP works.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = MailSetting::query()->first() ?? MailSetting::current();

        $payload = [
            'is_enabled' => (bool) ($data['is_enabled'] ?? false),
            'mailer' => $data['mailer'] ?? 'smtp',
            'host' => $data['host'] ?? null,
            'port' => (int) ($data['port'] ?? 587),
            'username' => $data['username'] ?? null,
            'encryption' => $data['encryption'] ?? 'tls',
            'from_address' => $data['from_address'] ?? null,
            'from_name' => $data['from_name'] ?? null,
            'test_to_email' => $data['test_to_email'] ?? null,
        ];

        if (filled($data['password'] ?? null)) {
            $payload['password'] = $data['password'];
        }

        $settings->fill($payload);
        $settings->save();
        MailSetting::flushCache();
        MailSetting::current()->applyToConfig();

        $this->form->fill([
            ...$payload,
            'password' => '',
        ]);

        Notification::make()
            ->title('SMTP settings saved')
            ->success()
            ->send();
    }

    public function sendTestEmail(): void
    {
        $this->save();

        $settings = MailSetting::current();
        $to = $this->data['test_to_email'] ?? $settings->test_to_email ?? $settings->from_address;

        if (blank($to)) {
            Notification::make()
                ->title('Add a test email address first')
                ->danger()
                ->send();

            return;
        }

        if (! $settings->is_enabled) {
            Notification::make()
                ->title('Enable SMTP first')
                ->body('Turn on "Enable SMTP from Admin", save, then test.')
                ->warning()
                ->send();

            return;
        }

        try {
            $settings->applyToConfig();
            Mail::mailer(config('mail.default'))->to($to)->send(new SmtpTestMail('Sent from Admin → SMTP Settings'));

            Notification::make()
                ->title('Test email sent')
                ->body('Check inbox (and spam) for: '.$to)
                ->success()
                ->send();
        } catch (\Throwable $e) {
            report($e);

            Notification::make()
                ->title('SMTP test failed')
                ->body($e->getMessage())
                ->danger()
                ->persistent()
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sendTestEmail')
                ->label('Send Test Email')
                ->icon('heroicon-o-paper-airplane')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Send SMTP test email?')
                ->modalDescription('Settings will be saved first, then a test email will be sent to the "Send Test To" address.')
                ->action(fn () => $this->sendTestEmail()),
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
                                ->label('Save SMTP Settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                            Action::make('test')
                                ->label('Save & Send Test Email')
                                ->color('warning')
                                ->action('sendTestEmail'),
                        ]),
                    ]),
            ]);
    }
}
