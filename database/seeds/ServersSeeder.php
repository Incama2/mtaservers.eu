<?php

use Illuminate\Database\Seeder;

class ServersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servers')->insert(['ip' => '145.239.149.158:22003']); // SEE
        DB::table('servers')->insert(['ip' => '213.181.201.216:22003']); // HL
    }
}
