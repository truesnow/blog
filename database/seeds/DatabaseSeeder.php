<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(RepliesTableSeeder::class);
        $this->call(MottosTableSeeder::class);
        $this->call(BookmarkCategoriesTableSeeder::class);
        $this->call(BookmarksTableSeeder::class);
        $this->call(WorksTableSeeder::class);
		$this->call(PagesTableSeeder::class);
        $this->call(AbbrsTableSeeder::class);
        $this->call(MilestonesTableSeeder::class);
        $this->call(WikiCatesTableSeeder::class);
        $this->call(WikiCatesTableSeeder::class);
        $this->call(WikiItemsTableSeeder::class);
        $this->call(TextContentsTableSeeder::class);

        Model::reguard();
    }
}
