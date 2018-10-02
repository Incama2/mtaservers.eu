<?php

use Faker\Generator as Faker;

$factory->define(App\OnlinePlayer::class, function (Faker $faker) {
    return [
        'serverID' => random_int(1, 2),
        'count' => random_int(1,500),
        'date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});
