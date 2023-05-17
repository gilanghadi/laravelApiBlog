<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DumySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'admin@mail.com',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'firstname' => 'admin',
                'lastname' => 'admin',
            ],
            [
                'email' => 'toni@mail.com',
                'username' => 'toni',
                'password' => Hash::make('password'),
                'firstname' => 'toni',
                'lastname' => 'toni',
            ],
            [
                'email' => 'sam@mail.com',
                'username' => 'sam',
                'password' => Hash::make('password'),
                'firstname' => 'sam',
                'lastname' => 'sam',
            ],

        ]);
        DB::table('posts')->insert([
            [
                'title' => 'welcome',
                'news_content' => Str::random(100),
                'author' => 1
            ],
            [
                'title' => 'pengumuman',
                'news_content' => Str::random(100),
                'author' => 1
            ],
        ]);
    }
}
