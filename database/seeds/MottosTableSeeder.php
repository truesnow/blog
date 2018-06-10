<?php

use Illuminate\Database\Seeder;
use App\Models\Motto;

class MottosTableSeeder extends Seeder
{
    public function run()
    {
        $mottos = factory(Motto::class)->times(50)->make()->each(function ($motto, $index) {

        });

        Motto::insert($mottos->toArray());
    }

}
