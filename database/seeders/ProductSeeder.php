<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();


        Tag::factory(15)->create();

        foreach (['S', 'M', 'L', 'XL', 'XXL'] as $value) {
            ProductSize::query()->create([
                'name' => $value,
            ]);
        }

        foreach (['#FF0000', '#808000', '#0000FF', '#000080', '#00FFFF'] as $value) {
            ProductColor::query()->create([
                'name' => $value,
            ]);
        }

        for ($i = 0; $i < 100; $i++) {
            $name = fake()->text(100);
            Product::query()->create([
                'category_id' => rand(2, 4),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(7) . $i,
                'img_thumbnail' => 'https://canifa.com/img/1517/2000/resize/3/t/3ts24s005-sw001-thumb.webp',
                'price_regular' => 200000,
                'price_sale' => 100000,
            ]);
        }

        for ($i = 1; $i < 100; $i++) {
            ProductGallery::query()->create([
                'product_id' => $i,
                'image' => 'https://canifa.com/img/1517/2000/resize/3/t/3ts24s005-sw001-thumb.webp',
            ]);

            ProductGallery::query()->create([
                'product_id' => $i,
                'image' => 'https://canifa.com/img/1517/2000/resize/3/t/3ts24s005-sw001-thumb.webp',
            ]);
        }

        for ($i = 1; $i < 101; $i++) {
            DB::table('product_tag')->insert([
                ['product_id' => $i, 'tag_id' => rand(1, 8)],
                ['product_id' => $i, 'tag_id' => rand(9, 14)],
            ]);
        }

        for ($productID = 1; $productID < 101; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID < 6; $sizeID++) {
                for ($colorID = 1; $colorID < 6; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 100,
                        'image' => 'https://canifa.com/img/1517/2000/resize/3/t/3ts24s005-sw001-thumb.webp',
                    ];
                }
            }
        }

        DB::table('product_variants')->insert($data);
    }
}
