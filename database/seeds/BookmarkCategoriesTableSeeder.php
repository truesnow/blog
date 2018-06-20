<?php

use Illuminate\Database\Seeder;
use App\Models\BookmarkCategory;

class BookmarkCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker\Generator::class);
        // 先生成一级书签分类
        $bookmark_categories = factory(BookmarkCategory::class)->times(5)->make()->each(function ($bookmark_category, $index) {
            $bookmark_category->parent_id = 0;
        });

        BookmarkCategory::insert($bookmark_categories->toArray());

        // 生成二级分类
        $first_category_ids = BookmarkCategory::where('parent_id', 0)->pluck('id')->toArray();
        $second_bookmark_categories = factory(BookmarkCategory::class)->times(25)->make()->each(function ($bookmark_category, $index) use ($faker, $first_category_ids) {
            $bookmark_category->parent_id = $faker->randomElement($first_category_ids);
        });

        BookmarkCategory::insert($second_bookmark_categories->toArray());
    }
}
