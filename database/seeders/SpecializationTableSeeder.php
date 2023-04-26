<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Specializations\Specialization;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations =[
            ['en' => 'Arabic' , 'ar' => 'عربي'],
            ['en' => 'English' , 'ar' => 'انجليزي'],
            ['en' => 'scince' , 'ar' => 'علوم'],
            ['en' => 'math' , 'ar' => 'حساب'],
        ];
        foreach($specializations as $s){
            Specialization::create([
                'Name' => $s
            ]);
        }
    }
}
