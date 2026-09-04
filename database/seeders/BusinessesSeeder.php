<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Category;
use App\Models\DistinctiveTrait;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusinessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $categories = Category::all();
        $distinctiveTraits = DistinctiveTrait::all();

        for ($i = 0; $i < rand(4, 6); $i++) {
            $name = $faker->company();

            $newbusiness = new Business();
            $newbusiness->name = $name;
            $newbusiness->slug = Str::slug($name);
            $newbusiness->story = $faker->paragraph();
            $newbusiness->address = $faker->address();
            $newbusiness->contact = $faker->phoneNumber();
            $newbusiness->category_id = $categories->random()->id;
            $newbusiness->save();

            $newbusiness->distinctiveTraits()->attach(
                $distinctiveTraits->random(rand(2, 3))
            );
        }
    }
}
