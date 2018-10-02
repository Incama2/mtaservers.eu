<?php

use Illuminate\Database\Seeder;

class OnlinePlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\OnlinePlayer::class, 500)->create();
    }
}
