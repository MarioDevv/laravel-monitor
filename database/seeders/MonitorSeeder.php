<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $monitorId1 = DB::table('monitors')->insertGetId(
            [
                'url'        => 'https://example.com',
                'interval'   => '60',
                'state'      => 'active',
                'time_out'   => '30',
                'last_check' => now(),
            ]);

        $monitorId2 = DB::table('monitors')->insertGetId(
            [
                'url'        => 'https://test.com',
                'interval'   => '60',
                'state'      => 'inactive',
                'time_out'   => '60',
                'last_check' => now(),
            ]);

        $historyId1 = DB::table('history')->insertGetId(
            [
                'pinged_at'     => now(),
                'state'         => 1,
                'response_time' => 0.23,
            ]);

        $historyId2 = DB::table('history')->insertGetId(
            [
                'pinged_at'     => now(),
                'state'         => 1,
                'response_time' => 0.45,
            ]);

        DB::table('monitors_history')->insert(
            [
                ['monitor_id' => $monitorId1, 'history_id' => $historyId1],
                ['monitor_id' => $monitorId2, 'history_id' => $historyId2],
            ]);


        echo "Datos insertados correctamente.\n";
    }
}
