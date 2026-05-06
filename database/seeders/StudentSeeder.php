<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $student = [
            [
            "last_name" => "Ahmadi",
            "img_url" =>"images/someting.jpg " ,
            "user_id" => 2,
            "phone" => "0797547689",
            "tazkira" => "29657453"
            ],
             [
            "last_name" => "Hamidi",
            "img_url" =>"images/somet   ing.jpg " ,
            "user_id" => 3,
            "phone" => "0797541243",
            "tazkira" => "2963456"
            ]
        ];
         DB::table('students')->insert($student);
    }
}
