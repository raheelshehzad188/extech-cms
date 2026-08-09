<?php

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Support\PricingDefaults;

$plans = PricingDefaults::apply(replaceExisting: true);

echo 'Pricing plans: '.$plans->count().PHP_EOL;
foreach ($plans as $plan) {
    echo '- '.$plan->name.' ('.$plan->monthly_price.' / '.$plan->yearly_price.')'.PHP_EOL;
}
