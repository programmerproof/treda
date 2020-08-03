<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Store;

class StoreTableSeeder extends Seeder
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
        factory(Store::class, 150)->create(['user_id' => $user_id]);
    }

    public function down()
    {
        \DB::table('store')->delete();
    }
}
