<?php

namespace Database\Seeders;

use App\Models\Strength;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrengthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $strengths = [
            "Fatto a mano",
            "Tramandato da generazioni",
            "Su misura",
            "Sostenibile",
            "Solo su prenotazione"
        ];

        foreach ($strengths as $strength) {

            $newstrength = new Strength();
            $newstrength->name = $strength;
            $newstrength->save();
        }
    }
}
