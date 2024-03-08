<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'id' => 1,
            'title' => 'manga',
            'updated_at' => Carbon::now(),
        ];
        DB::table('threads')->insert($param);

        $param = [
            'id' => 2,
            'title' => 'game',
            'updated_at' => Carbon::now(),
        ];
        DB::table('threads')->insert($param);
    }
}
