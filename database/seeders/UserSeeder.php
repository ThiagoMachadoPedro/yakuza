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
                              'name' => 'Ricardo',
                              'imageUser' => 'https://th.bing.com/th/id/R.a5a06254d71e4d18cb6179ed0a8af870?rik=KXOBGhSoNXDVuQ&pid=ImgRaw&r=0',
                              'nick' => 'ursinho',
                              'email' => 'xx@gmail.com',
                              'password' => bcrypt('123456789'),
                    ]);

                    User::create([
                              'name' => 'Alex',
                              'imageUser' => 'https://th.bing.com/th/id/R.a5a06254d71e4d18cb6179ed0a8af870?rik=KXOBGhSoNXDVuQ&pid=ImgRaw&r=0',
                              'nick' => 'Vicius',
                              'email' => 'cc@gmail.com',
                              'password' => bcrypt('123456789'),
                    ]);

                    User::create([
                              'name' => 'Fulano',
                              'imageUser' => 'https://th.bing.com/th/id/R.a5a06254d71e4d18cb6179ed0a8af870?rik=KXOBGhSoNXDVuQ&pid=ImgRaw&r=0',
                              'nick' => 'Fulano Nick',
                              'email' => 'vv@gmail.com',
                              'password' => bcrypt('123456789'),
                    ]);

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
