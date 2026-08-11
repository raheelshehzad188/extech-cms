<?php

namespace App\Support;

use App\Models\Brand;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class BrandDefaults
{
    /**
     * @return array<int, array{name: string, source: string, file: string, sort_order: int}>
     */
    public static function brandSources(): array
    {
        return [
            ['name' => 'Brand 01', 'source' => 'assets/img/brand/01.png', 'file' => 'brand-01.png', 'sort_order' => 1],
            ['name' => 'Brand 02', 'source' => 'assets/img/brand/02.png', 'file' => 'brand-02.png', 'sort_order' => 2],
            ['name' => 'Brand 03', 'source' => 'assets/img/brand/03.png', 'file' => 'brand-03.png', 'sort_order' => 3],
            ['name' => 'Brand 04', 'source' => 'assets/img/brand/04.png', 'file' => 'brand-04.png', 'sort_order' => 4],
            ['name' => 'Brand Trust', 'source' => 'assets/img/brand.png', 'file' => 'brand-trust.png', 'sort_order' => 5],
        ];
    }

    public static function copyLogo(string $publicRelativePath, string $fileName): string
    {
        $source = public_path($publicRelativePath);
        $directory = storage_path('app/public/brands');

        if (! File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $destination = $directory.DIRECTORY_SEPARATOR.$fileName;

        if (File::isFile($source)) {
            File::copy($source, $destination);
        }

        return 'brands/'.$fileName;
    }

    /**
     * @return Collection<int, Brand>
     */
    public static function apply(bool $replaceExisting = true): Collection
    {
        if ($replaceExisting) {
            Brand::query()->delete();
        }

        if (! $replaceExisting && Brand::query()->exists()) {
            return Brand::query()->orderBy('sort_order')->get();
        }

        foreach (self::brandSources() as $brand) {
            Brand::query()->create([
                'name' => $brand['name'],
                'logo' => self::copyLogo($brand['source'], $brand['file']),
                'url' => null,
                'is_published' => true,
                'sort_order' => $brand['sort_order'],
            ]);
        }

        return Brand::query()->orderBy('sort_order')->get();
    }
}
