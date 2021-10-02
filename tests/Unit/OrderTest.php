<?php

namespace Tests\Unit;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Repo\OrderRepository;
use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\RolesTableSeeder;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use  RefreshDatabase, WithFaker;

    protected $product, $category, $user;

    protected function setUpVariables(): void
    {
        (new OrderStatusSeeder)->run();
        (new RolesTableSeeder())->run();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->product = Product::factory(3, ['category_id' => $this->category->id])->create();

        Auth::loginUsingId($this->user->id);

    }

    public function test_order_create()
    {
        $this->setUpVariables();
        $data = [
            "name" => $this->faker->name,
            "surname" => $this->faker->lastName,
            "phone" => $this->faker->e164PhoneNumber,
            "email" => $this->faker->email,
            "country" => $this->faker->country,
            "city" => $this->faker->city,
            "address" => $this->faker->address,
        ];
        $cart = Cart::instance('cart');
        foreach ($this->product as $product) {
            $cart->add($product->id, $product->title, 3, $product->price())->associate($product);
        }

        $order = new OrderRepository;
        $request = new OrderStoreRequest($data);

        $order = $order->create($request);

        $this->assertInstanceOf(Order::class, $order);  //заказ создан

        //Проверка контроллера OrderController
        $this->assertEquals(9, $cart->count());  // корзина еще не пуска
        $cart->destroy();
        $this->assertEquals(0, $cart->count());  // корзина пуста

    }
}
