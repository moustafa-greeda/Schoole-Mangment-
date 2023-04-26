<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BloodTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BloodTypeSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(NationalitieTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SpecializationTableSeeder::class);
    }
}
