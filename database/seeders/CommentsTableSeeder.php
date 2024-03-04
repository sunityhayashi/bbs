<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'thread_id' => 1,
            'name' => 'kenji',
            'message' => 'manga is fun',
            'password' => 'kenjikenji'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'thread_id' => 1,
            'name' => 'sato',
            'message' => 'yes',
            'password' => 'satosato'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'thread_id' => 2,
            'name' => 'kenji',
            'message' => 'game is fun',
            'password' => 'kenjikenji'
        ];
        DB::table('comments')->insert($param);
    }
}
