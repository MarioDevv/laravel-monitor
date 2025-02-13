<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonitorSeeder extends Seeder
{
    public function run(): void
    {
        $monitors = [];
        for ($i = 1; $i <= 5; $i++) {
            $monitors[] = DB::table('monitors')->insertGetId(
                [
                    'url'            => "https://example$i.com",
                    'interval'       => rand(30, 120),
                    'state'          => rand(1, 3),
                    'time_out'       => rand(10, 90),
                    'last_check'     => now()->subMinutes(rand(1, 60)),
                    'ssl_expiration' => null
                ]);
        }

        $histories = [];
        for ($j = 1; $j <= 10; $j++) {
            $histories[] = DB::table('history')->insertGetId(
                [
                    'pinged_at'     => now()->subMinutes(rand(1, 1440)),
                    'state'         => rand(1, 3),
                    'response_time' => round(mt_rand(10, 500) / 1000, 3),
                ]);
        }

        $monitorHistory = [];
        foreach ($monitors as $monitorId) {
            $assignedHistories = array_rand($histories, rand(2, 4));
            foreach ((array)$assignedHistories as $historyIndex) {
                $monitorHistory[] = [
                    'monitor_id' => $monitorId,
                    'history_id' => $histories[$historyIndex],
                ];
            }
        }

        DB::table('monitors_history')->insert($monitorHistory);

        echo "Datos insertados correctamente con mayor variedad de monitores e historiales.\n";
    }
}

