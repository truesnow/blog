<?php

use App\Models\WikiItem;
use Illuminate\Database\Seeder;

class WikiItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = factory(WikiItem::class)->times(1000)->make()->each(function ($record) {
        });
        WikiItem::insert($records->toArray());
    }
}
