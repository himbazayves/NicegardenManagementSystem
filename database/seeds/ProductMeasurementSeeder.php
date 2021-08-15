<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_measurements')->insert([
            'name' => "Kilogram",
            'abbreviation' => "KG",
        ]);


        DB::table('product_measurements')->insert([
            'name' => "Littre",
            'abbreviation' => "L",
        ]);


        DB::table('product_measurements')->insert([
            'name' => "Box",
            'abbreviation' => "box",
        ]);

        DB::table('product_measurements')->insert([
            'name' => "Mettre",
            'abbreviation' => "M",
        ]);
    }
    
}
