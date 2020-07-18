<?php

use Illuminate\Database\Seeder;
use App\Models\WikiSubject;

class WikiSubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = factory(WikiSubject::class)->times(30)->make()->each(function ($record) {

        });
        WikiSubject::insert($records->toArray());
    }
}
