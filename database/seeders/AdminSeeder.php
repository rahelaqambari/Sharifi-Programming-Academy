<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('admins')->insert([
            "last_name" => "Qambari",
            "img_url" =>"images/me.jpg " ,
            "user_id" => 1,
            "bio" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis, suscipit minus id, voluptates dignissimos voluptatibus magnam eligendi voluptas perspiciatis sequi quibusdam earum commodi nesciunt ipsum, reprehenderit qui? Veniam."
        ]);
         
    }
}
