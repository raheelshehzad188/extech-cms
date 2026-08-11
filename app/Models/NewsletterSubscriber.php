<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'subscribed_at' => 'datetime',
            'unsubscribed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (NewsletterSubscriber $subscriber): void {
            if (blank($subscriber->unsubscribe_token)) {
                $subscriber->unsubscribe_token = Str::random(48);
            }

            if (blank($subscriber->subscribed_at) && $subscriber->status === 'subscribed') {
                $subscriber->subscribed_at = now();
            }
        });
    }

    public function scopeSubscribed(Builder $query): Builder
    {
        return $query->where('status', 'subscribed');
    }

    public function isSubscribed(): bool
    {
        return $this->status === 'subscribed';
    }

    public function markSubscribed(?string $source = null): void
    {
        $this->forceFill([
            'status' => 'subscribed',
            'subscribed_at' => now(),
            'unsubscribed_at' => null,
            'source' => $source ?: ($this->source ?: 'footer'),
        ])->save();
    }

    public function markUnsubscribed(): void
    {
        $this->forceFill([
            'status' => 'unsubscribed',
            'unsubscribed_at' => now(),
        ])->save();
    }

    public function unsubscribeUrl(): string
    {
        return route('newsletter.unsubscribe', $this->unsubscribe_token);
    }
}
