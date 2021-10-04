<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\RolesTableSeeder;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductUpdateEmailNotifyTest extends TestCase
{
    use RefreshDatabase;

    protected $product, $category, $user;

    protected function setUpVariables(): void
    {
        (new OrderStatusSeeder)->run();
        (new RolesTableSeeder())->run();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->product = Product::factory(['category_id' => $this->category->id])->create();

        Auth::loginUsingId($this->user->id);

    }

    public function test_email_on_update()
    {
        $this->setUpVariables();
        auth()->user()->addToWishList($this->product);
        Cart::instance('wishlist')->add($this->product->id, $this->product->title, 1, $this->product->price())->associate($this->product);

        $this->product->update(['in_stock' => 0]);
        $this->product->update(['in_stock' => 10]);

        // ставил dd() в нотификации, до отправки почты доходит, но в лог не пишет. наверно тесто впринципе не пишут ничего в логи. Гугл сильно не
        // помог
    }
}
