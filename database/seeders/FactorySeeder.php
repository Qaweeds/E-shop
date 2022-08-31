<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'email' => 'admin@admin.com',
            'password' => \Hash::make('admin'),
            'role_id' => Role::query()->where('name', config('constants.db.roles.admin'))->value('id')
        ];
        User::factory($admin)->create();
        User::factory(20)->create();

        Category::factory(3)->create()->each(function ($cat) {
            Product::factory(rand(5, 10))->state(['category_id' => $cat->id])->create()->each(function ($product) {
                ProductImage::factory(rand(1, 3))->state(['product_id' => $product->id])->create();
            });
        });

        Order::factory(100)->create(); // pivot внутри фабрики реализован
    }
}
