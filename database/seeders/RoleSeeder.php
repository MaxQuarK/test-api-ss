<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
        DB::table('roles')->insert([
            'title' => "manager",
            'created_at' => $dateNow,
            'updated_at' => $dateNow
        ]);

        DB::table('roles')->insert([
            'title' => "employer",
            'created_at' => $dateNow,
            'updated_at' => $dateNow
        ]);
    }
}
