<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Subject;
use App\Models\User;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $user_ids = User::all()->pluck('id')->toArray();
        $subject_ids = Subject::where('parent_id', '!=', 0)->pluck('id')->toArray();
        $articles = factory(Article::class)->times(150)->make()->each(function ($article, $index) use ($faker, $user_ids, $subject_ids) {
            $article->user_id = $faker->randomElement($user_ids);
            $article->subject_id = $faker->randomElement($subject_ids);
        });

        Article::insert($articles->toArray());
    }

}
