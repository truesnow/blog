<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);

        $messages = factory(Message::class)->times(100)->make()->each(function ($message) use ($faker, $user_ids) {
            $message->user_id = $faker->randomElement($user_ids);
        });

        Message::insert($messages->toArray());
    }
}
