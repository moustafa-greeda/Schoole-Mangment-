<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Religions\Religion;
use Illuminate\Support\Facades\DB;

class ReligionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('religions')->delete();
        $Religions =[
            [
                'en'=> 'Muslim',
                'ar'=> 'مسلم'
            ],
            [
                'en'=> 'Christian',
                'ar'=> 'مسيحي'
            ],
            [
                'en'=> 'Other',
                'ar'=> 'غيرذلك'
            ],  
        ];
        foreach($Religions as $R){
            Religion::create(['Name' => $R]);
        }
    }
}
