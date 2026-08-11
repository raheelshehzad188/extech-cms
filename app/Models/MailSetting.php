<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class MailSetting extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'port' => 'integer',
        ];
    }

    public static function current(): self
    {
        $attributes = Cache::remember('mail_settings', 60, function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::query()->create([
                    'is_enabled' => false,
                    'mailer' => 'smtp',
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => (int) config('mail.mailers.smtp.port', 587),
                    'username' => config('mail.mailers.smtp.username'),
                    'from_address' => config('mail.from.address'),
                    'from_name' => config('mail.from.name'),
                    'encryption' => 'tls',
                ]);
            }

            return $settings->getAttributes();
        });

        $model = static::query()->newModelInstance();
        $model->setRawAttributes($attributes, true);
        $model->exists = true;

        return $model;
    }

    public static function flushCache(): void
    {
        Cache::forget('mail_settings');
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::flushCache());
        static::deleted(fn () => static::flushCache());
    }

    public function setPasswordAttribute(?string $value): void
    {
        if ($value === null || $value === '') {
            return;
        }

        $this->attributes['password'] = Crypt::encryptString($value);
    }

    public function decryptedPassword(): ?string
    {
        $password = $this->attributes['password'] ?? null;

        if (blank($password)) {
            return null;
        }

        try {
            return Crypt::decryptString($password);
        } catch (\Throwable) {
            // Legacy/plain value fallback
            return $password;
        }
    }

    public function applyToConfig(): void
    {
        if (! $this->is_enabled) {
            return;
        }

        $mailer = $this->mailer ?: 'smtp';

        config([
            'mail.default' => $mailer,
            'mail.from.address' => $this->from_address ?: config('mail.from.address'),
            'mail.from.name' => $this->from_name ?: config('mail.from.name'),
        ]);

        if ($mailer !== 'smtp') {
            return;
        }

        $scheme = match ($this->encryption) {
            'ssl' => 'smtps',
            'tls', 'none', null, '' => null,
            default => null,
        };

        config([
            'mail.mailers.smtp.transport' => 'smtp',
            'mail.mailers.smtp.host' => $this->host,
            'mail.mailers.smtp.port' => $this->port ?: 587,
            'mail.mailers.smtp.username' => $this->username,
            'mail.mailers.smtp.password' => $this->decryptedPassword(),
            'mail.mailers.smtp.scheme' => $scheme,
            'mail.mailers.smtp.encryption' => in_array($this->encryption, ['tls', 'ssl'], true)
                ? $this->encryption
                : null,
        ]);
    }
}
