<?php

namespace App\Console\Commands;

use App\Support\MarketplaceDefaults;
use App\Support\SystemPages;
use Illuminate\Console\Command;

class SeedMarketplaceCommand extends Command
{
    protected $signature = 'marketplace:seed';

    protected $description = 'Create dummy marketplace categories and products only if the catalog is empty';

    public function handle(): int
    {
        SystemPages::ensure();
        $products = MarketplaceDefaults::apply();

        $this->info('Marketplace products: '.$products->count());

        return self::SUCCESS;
    }
}
