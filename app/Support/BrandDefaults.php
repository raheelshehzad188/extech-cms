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
            ['name' => 'Brand Logo 1', 'source' => 'assets/img/brand-logo/brandLogo1_1.svg', 'file' => 'brandLogo1_1.svg', 'sort_order' => 1],
            ['name' => 'Brand Logo 2', 'source' => 'assets/img/brand-logo/brandLogo1_2.svg', 'file' => 'brandLogo1_2.svg', 'sort_order' => 2],
            ['name' => 'Brand Logo 3', 'source' => 'assets/img/brand-logo/brandLogo1_3.svg', 'file' => 'brandLogo1_3.svg', 'sort_order' => 3],
            ['name' => 'Brand Logo 4', 'source' => 'assets/img/brand-logo/brandLogo1_4.svg', 'file' => 'brandLogo1_4.svg', 'sort_order' => 4],
            ['name' => 'Brand Logo 5', 'source' => 'assets/img/brand-logo/brandLogo1_5.svg', 'file' => 'brandLogo1_5.svg', 'sort_order' => 5],
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
