<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
          /**
           * Run the database seeds.
           */
          public function run(): void
          {


                    User::create([
                              'name' => 'Thiago',
                              'imageUser' => 'https://th.bing.com/th/id/R.a5a06254d71e4d18cb6179ed0a8af870?rik=KXOBGhSoNXDVuQ&pid=ImgRaw&r=0',
                              'nick' => 'Big Boss',
                              'access_level' => 1,
                              'email' => 'bb@gmail.com',
                              'password' => bcrypt('123456789'),
                    ]);



          }
}
