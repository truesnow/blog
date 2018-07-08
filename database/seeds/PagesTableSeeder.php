<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $pages = factory(Page::class)->times(3)->make()->each(function ($page, $index) {
            if (0 == $index) {
                $page->name = 'about';
                $page->description = '关于页';
            }
            if (1 == $index) {
                $page->name = 'thanks';
                $page->description = '致谢页';
            }
            if (2 == $index) {
                $page->name = 'contact';
                $page->description = '联系我页';
            }
        });

        Page::insert($pages->toArray());
    }
}
