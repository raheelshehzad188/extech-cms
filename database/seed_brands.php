<?php

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Support\BrandDefaults;

$brands = BrandDefaults::apply(replaceExisting: true);

echo 'Brands: '.$brands->count().PHP_EOL;
foreach ($brands as $brand) {
    echo '- '.$brand->name.' ('.$brand->logo.')'.PHP_EOL;
}
