<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $subjects = factory(Subject::class)->times(5)->make();
        Subject::insert($subjects->makeVisible(['article_count'])->toArray());

        $subject_ids = Subject::all()->pluck('id')->toArray();
        $sub_subjects = factory(Subject::class)->times(25)->make()->each(function ($subject) use ($faker, $subject_ids) {
            $subject->parent_id = $faker->randomElement($subject_ids);
        });

        Subject::insert($sub_subjects->toArray());
    }
}
