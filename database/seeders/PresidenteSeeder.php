<?php

namespace Database\Seeders;

use App\Models\Presidente;
use Illuminate\Database\Seeder;

class PresidenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presidente::truncate();
        Presidente::factory()
            ->count(20)
            ->create();


    }
}
