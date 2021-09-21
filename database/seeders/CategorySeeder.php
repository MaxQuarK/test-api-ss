<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        DB::table('categories')->insert([
            'title' => "App",
            'description' => "Part 1",
            'created_at' => $dateNow,
            'updated_at' => $dateNow
        ]);

        DB::table('categories')->insert([
            'title' => "News",
            'description' => "Alarm!!",
            'created_at' => $dateNow,
            'updated_at' => $dateNow
        ]);
    }
}
