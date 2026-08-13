<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceCategory;
use App\Models\MarketplaceProduct;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketplaceController extends Controller
{
    public function index(Request $request): View
    {
        $categories = MarketplaceCategory::query()
            ->where('is_published', true)
            ->withCount(['products as products_count' => fn ($q) => $q->where('is_published', true)])
            ->orderBy('sort_order')
            ->get();

        $query = MarketplaceProduct::query()
            ->where('is_published', true)
            ->with('category');

        $categorySlug = (string) $request->query('category', '');
        $activeCategory = null;

        if ($categorySlug !== '') {
            $activeCategory = $categories->firstWhere('slug', $categorySlug);
            if ($activeCategory) {
                $query->where('marketplace_category_id', $activeCategory->id);
            }
        }

        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        if (is_numeric($minPrice)) {
            $query->whereRaw('COALESCE(NULLIF(sale_price, 0), price) >= ?', [(float) $minPrice]);
        }

        if (is_numeric($maxPrice)) {
            $query->whereRaw('COALESCE(NULLIF(sale_price, 0), price) <= ?', [(float) $maxPrice]);
        }

        $sort = (string) $request->query('sort', 'latest');
        match ($sort) {
            'price_low' => $query->orderByRaw('COALESCE(NULLIF(sale_price, 0), price) ASC'),
            'price_high' => $query->orderByRaw('COALESCE(NULLIF(sale_price, 0), price) DESC'),
            default => $query->orderByDesc('is_featured')->orderBy('sort_order')->orderByDesc('id'),
        };

        $products = $query->paginate(9)->withQueryString();

        $seo = Page::query()->where('slug', 'marketplace')->where('is_published', true)->first()
            ?? new Page([
                'title' => 'Marketplace',
                'breadcrumb_title' => 'Marketplace',
                'meta_title' => 'Marketplace | '.SiteSetting::current()->site_name,
            ]);

        return view('frontend.marketplace.index', [
            'products' => $products,
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'sort' => $sort,
            'seo' => $seo,
        ]);
    }

    public function show(MarketplaceProduct $product): View
    {
        abort_unless($product->is_published, 404);

        $related = MarketplaceProduct::query()
            ->where('is_published', true)
            ->where('id', '!=', $product->id)
            ->when($product->marketplace_category_id, fn ($q) => $q->where('marketplace_category_id', $product->marketplace_category_id))
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $categories = MarketplaceCategory::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.marketplace.show', [
            'product' => $product,
            'related' => $related,
            'categories' => $categories,
            'seo' => $product,
        ]);
    }
}
