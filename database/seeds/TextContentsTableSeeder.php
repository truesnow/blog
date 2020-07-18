<?php

use App\Models\TextContent;
use Illuminate\Database\Seeder;

class TextContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = factory(TextContent::class)->times(100)->make()->each(function ($record) {
        });
        TextContent::insert($records->toArray());
    }
}
