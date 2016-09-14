<?php

use Illuminate\Database\Seeder;
use App\Models\Item as Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Item::class, 50)->create();
    }
}
