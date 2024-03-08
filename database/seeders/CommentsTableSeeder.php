<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    const THREAD_ID_1 = 1;
    const THREAD_ID_2 = 2;

    public function run(): void
    {   
        $param = [
            'id' => 1,
            'thread_id' => self::THREAD_ID_1,
            'name' => 'kenji',
            'message' => 'manga is fun',
            'password' => password_hash('kenjikenji', PASSWORD_DEFAULT, ['cost' => 10]),
            'created_at' => Carbon::now(),
        ];
        DB::table('comments')->insert($param);

        $param = [
            'id' => 2,
            'thread_id' => self::THREAD_ID_1,
            'name' => 'sato',
            'message' => 'yes',
            'password' => password_hash('satosato', PASSWORD_DEFAULT, ['cost' => 10]),
            'created_at' => Carbon::now(),
        ];
        DB::table('comments')->insert($param);

        $param = [
            'id' => 3,
            'thread_id' => self::THREAD_ID_2,
            'name' => 'kenji',
            'message' => 'game is fun',
            'password' => password_hash('kenjikenji', PASSWORD_DEFAULT, ['cost' => 10]),
            'created_at' => Carbon::now(),
        ];
        DB::table('comments')->insert($param);
    }
}
