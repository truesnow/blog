<?php

use Illuminate\Database\Seeder;
use App\Models\Bookmark;
use App\Models\BookmarkCategory;

class BookmarksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $second_category_ids = BookmarkCategory::where('parent_id', '!=', 0)->pluck('id')->toArray();
        $bookmarks = factory(Bookmark::class)->times(50)->make()->each(function ($bookmark, $index) use ($faker, $second_category_ids) {
            $bookmark->category_id = $faker->randomElement($second_category_ids);
        });

        Bookmark::insert($bookmarks->toArray());
    }
}
