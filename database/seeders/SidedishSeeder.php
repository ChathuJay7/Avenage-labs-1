<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SidedishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('side_dishes')->insert([
            [
                'side_dish'=>'Wadai',
                "price"=>"45",
            ],
            [
                'side_dish'=>'Dhal curry',
                "price"=>"75",
            ],
            [
                'side_dish'=>'Fish curry',
                "price"=>"120",
            ],
        ]);
    }
}
