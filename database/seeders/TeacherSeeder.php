<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $teacher = [
            [
            "last_name" => "Hakimi",
            "degree" => "bachelor",
            "img_url" =>"images/someting.jpg " ,
            "user_id" => 4,
            "phone" => "079759087680",
             "bio" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis, suscipit minus id, voluptates dignissimos voluptatibus magnam eligendi voluptas perspiciatis sequi quibusdam earum commodi nesciunt ipsum, reprehenderit qui? Veniam."
         
            ],
             [
             "last_name" => "Hussini",
            "degree" => "Secandry School",
            "img_url" =>"images/someting.jpg " ,
            "user_id" => 5,
            "phone" => "0797543567",
             "bio" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis, suscipit minus id, voluptates dignissimos voluptatibus magnam eligendi voluptas perspiciatis sequi quibusdam earum commodi nesciunt ipsum, reprehenderit qui? Veniam."
         
            ]
        ];
        DB::table('teachers')->insert($teacher);
    }
}
