<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Genre;
use App\Models\Disc;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();
         Genre::factory(10)->hasAttached(
             Disc::factory()->count(3)
         )->create();
         Disc::factory(10)->hasAttached(
             Genre::factory()->count(3)
         )->create();
    }
}
