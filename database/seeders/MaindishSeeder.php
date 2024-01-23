<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaindishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('main_dishes')->insert([
            [
                'main_dish'=>'Rice',
                "price"=>"100",
            ],
            [
                'main_dish'=>'Rotty',
                "price"=>"20",
            ],
            [
                'main_dish'=>'Noodles',
                "price"=>"150",
            ],
        ]);
    }
}
