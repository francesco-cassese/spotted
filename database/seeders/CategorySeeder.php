<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            "Artigianato",
            "Cibo e ristorazione",
            "Servizi",
            "Cura della persona"
        ];

        foreach ($categories as $category) {

            $newcategory = new Category();
            $newcategory->name = $category;
            $newcategory->slug = Str::slug($category);
            $newcategory->save();
        }
    }
}
