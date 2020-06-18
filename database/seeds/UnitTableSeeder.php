<?php

use Illuminate\Database\Seeder;
use App\Models\Unit\Unit;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::insert([
        	['unit'=> 'Pc(s)'],
        	['unit'=> 'Meter(s)'],
        	['unit'=> 'Box(es)'],
        	
        ]);
    }
}
