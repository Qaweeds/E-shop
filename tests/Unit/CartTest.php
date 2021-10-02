<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected $product, $category;

    protected function setUpVariables(): void
    {
        $this->category = Category::factory()->create();
        $this->product = Product::factory(3, ['category_id' => $this->category->id])->create();

    }

    public function test_cart()
    {
        $this->setUpVariables();
        $cart = Cart::instance('cart');
        foreach ($this->product as $product) {
            $cart->add($product->id, $product->title, 3, $product->price())->associate($product);
        }
        $this->assertEquals(9, $cart->count());

        //В $cart->content() коллекция. удаляем первый ряд
        $cart->remove($cart->content()->first()->rowId);

        $this->assertEquals(6, $cart->count());

        // Сейчас 2 товара по 3 штуки. обновляем первый
        $cart->update($cart->content()->first()->rowId, 10);

        $this->assertEquals(13, $cart->count());
    }
}
