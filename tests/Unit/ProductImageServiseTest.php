<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Service\ProductImageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductImageServiseTest extends TestCase
{
    use RefreshDatabase;

    protected $category, $product, $images;

    protected function setUpVariables(): void
    {
        $this->category = Category::factory()->create();
        $this->product = Product::factory(['category_id' => $this->category->id])->create();
        $this->images[] = UploadedFile::fake()->image('test.png');
        $this->images[] = UploadedFile::fake()->image('test.png');

    }

    public function test_create_product_with_images()
    {
        $this->setUpVariables();
        $this->assertEquals(0, $this->product->gallery()->count());

        ProductImageService::addImagesToProduct($this->product, $this->images);

        $this->assertEquals(count($this->images), $this->product->gallery()->count());
    }

    public function test_create_product_without_images()
    {
        $this->setUpVariables();
        $this->assertEquals(0, $this->product->gallery()->count());

        ProductImageService::addImagesToProduct($this->product, []);

        $this->assertEquals(0, $this->product->gallery()->count());
    }

}
