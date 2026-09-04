<?php

namespace Database\Seeders;

use App\Models\DistinctiveTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistinctiveTraitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $distinctiveTraits = [
            "Fatto a mano",
            "Tramandato da generazioni",
            "Su misura",
            "Sostenibile",
            "Solo su prenotazione"
        ];

        foreach ($distinctiveTraits as $distinctiveTrait) {

            $newDistinctiveTrait = new DistinctiveTrait();
            $newDistinctiveTrait->name = $distinctiveTrait;
            $newDistinctiveTrait->save();
        }
    }
}
