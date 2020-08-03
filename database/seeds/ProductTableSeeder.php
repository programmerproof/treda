<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Store;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user_id = User::orderBy('id', 'ASC')->first()->id;
        $store_id = Store::orderBy('id', 'ASC')->first()->id;
        factory(Product::class, 5)->create(['user_id' => $user_id, 'store_id' => $store_id]);
    }

    public function down()
    {
        \DB::table('product')->delete();
    }
}
