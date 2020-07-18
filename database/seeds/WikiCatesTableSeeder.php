<?php

use App\Models\WikiCate;
use Illuminate\Database\Seeder;

class WikiCatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = factory(WikiCate::class)->times(12)->make()->each(function ($record) {
        });
        WikiCate::insert($records->toArray());
    }
}
