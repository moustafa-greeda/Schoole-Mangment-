<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TypeBloods\TypeBlood;

class BloodTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('type_bloods')->delete();
        $TypeBloods =['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
        foreach($TypeBloods as $a){
            TypeBlood::create(['Name' => $a]);
        }

    }
}
