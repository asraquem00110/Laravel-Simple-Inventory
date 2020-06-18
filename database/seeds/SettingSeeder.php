<?php

use Illuminate\Database\Seeder;
use App\Models\Setting\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
        	['key'=> 'barcodeZero', 'value' => 6],
        	['key'=> 'inboundZero', 'value' => 6],
        	['key'=> 'outboundZero', 'value' => 6],
        	['key'=> 'disZero', 'value' => 6],
            ['key'=> 'company', 'value' => "COMPANY NAME"],
            ['key'=> 'companylogo', 'value' => "LOGOsample.png"],
            ['key'=> 'companyaddress', 'value' => "Taguig City"],
            ['key'=> 'returnZero', 'value'=> 6],
        ]);
    }
}
