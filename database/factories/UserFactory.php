<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt("password"), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Pharmacy::class, function (Faker\Generator $faker) {

    $title = $faker->sentence;

    return [
        'registration_number'=>$faker->ean8,
        'trading_name'=>$faker->company,
        'address_1'=>$faker->streetName,
        'town'=>$faker->city,
        'county'=>$faker->state,
        'post_code'=>$faker->postcode,
        'phone'=>$faker->e164PhoneNumber,
        'website'=>$faker->url,
        'email'=>$faker->email,
        'verified'=>$faker->boolean,
    ];
});
$factory->define(App\Pharmacist::class, function (Faker\Generator $faker) {

    $title = $faker->sentence;

    return [
        'title'=>$faker->title,
        'forenames'=>$faker->firstName,
        'surname'=>$faker->lastName,
        'date_registered'=>\Carbon\Carbon::now(),
        'verified'=>$faker->boolean,
        'registration_number'=>$faker->ean8,
    ];
});

$factory->define(App\University::class, function (Faker\Generator $faker) {

    $title = $faker->sentence;

    return [
        'name'=>$faker->streetName,
    ];
});
