<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('settings')->delete();
        $data=[
            ['key' => 'current_session', 'value' => '2021-2022'],
            ['key' => 'school_title', 'value' => 'Gs'],
            ['key' => 'school_name', 'value' => 'Greeda Soft International Schools'],
            ['key' => 'end_first_term', 'value' => '01-12-2021'],
            ['key' => 'end_second_term', 'value' => '01-03-2022'],
            ['key' => 'phone', 'value' => '0123456789'],
            ['key' => 'address', 'value' => 'المنصوره'],
            ['key' => 'school_email', 'value' => 'info@greedasoft.com'],
            ['key' => 'logo', 'value' => 'Screenshot from 2023-03-25 16-45-08.png'],
        ];
        DB::table('settings')->insert($data);
    }
}
