<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DessertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('desserts')->insert([
            [
                'dessert'=>'Watalappam',
                "price"=>"40",
            ],
            [
                'dessert'=>'Jelly',
                "price"=>"20",
            ],
            [
                'dessert'=>'Pudding',
                "price"=>"25",
            ],
        ]);
    }
}
