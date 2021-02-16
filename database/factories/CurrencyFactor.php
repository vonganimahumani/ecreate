<?php

use Faker\Generator as Faker;

$factory->define(App\Currency::class, function (Faker $faker) {
    return [
        'base_currency' => 'EUR',
        'user_currency' => 'ZAR',
        'notify' => 1,
        'user_id' => factory('App\User')->create()->id,
    ];
});
