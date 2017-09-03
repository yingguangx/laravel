<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
		    'nickName'=>$faker->name,
				'mobile'=>$faker->phoneNumber,
				'headImgUrl'=>$faker->url,
				'district'=> '',
				'city'=>$faker->city,
				'money'=> rand(100,1000),
				'points'=> rand(100,1000),
				'key'=> str_random(16),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
