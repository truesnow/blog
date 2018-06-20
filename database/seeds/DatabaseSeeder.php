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
        $this->call(BookmarkCategorysTableSeeder::class);
		$this->call(BookmarksTableSeeder::class);

        Model::reguard();
    }
}
