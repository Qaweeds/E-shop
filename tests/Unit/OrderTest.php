<?php

namespace Tests\Unit;

use App\Http\Controllers\OrderController;
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

    protected function setUpVariables($balance): void
    {
        (new OrderStatusSeeder)->run();
        (new RolesTableSeeder())->run();

        $this->user = User::factory()->create(['balance' => $balance]);
        $this->category = Category::factory()->create();
        $this->product = Product::factory(3, ['category_id' => $this->category->id])->create();

        Auth::loginUsingId($this->user->id);

    }

    public function test_order_create()
    {
        $this->setUpVariables(100000);
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

        $this->assertEquals(auth()->user()->balance, $this->user->balance - $order->total); //сумма списалась
        $this->assertInstanceOf(Order::class, $order);  //заказ создан

        //Проверка контроллера OrderController
        $this->assertEquals(9, $cart->count());  // корзина еще не пуска
        $cart->destroy();
        $this->assertEquals(0, $cart->count());  // корзина пуста

    }

    public function test_order_create_when_not_enough_money(){
        $this->setUpVariables(100);
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

        $this->assertEquals(auth()->user()->balance, $this->user->balance); //сумма не списалась
        $this->assertNull($order);  //заказ  не создан создан

    }

}
