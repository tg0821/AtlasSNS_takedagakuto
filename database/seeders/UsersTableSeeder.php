<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// これでこのファイル内で「 DB::」 という記法を使えるようになる
use Illuminate\Support\Facades\DB;
// これでHashの機能が使えるようになる
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DB::table('users')->insert([
        ['username'=>'gakuto',
        'email'=>'gtakeda0821@gmail.com',
        'password'=>Hash::make('1999130821'),],
     ]);
    }
}
