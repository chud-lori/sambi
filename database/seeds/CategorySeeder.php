<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('categories')->insert([
                'kategori'       => $faker->name,
                'nomor_kategori' => $faker->unique()->randomDigit(10),
            ]);
        }
    }
}
