<?php

namespace App\Console\Commands;

use App\Jobs\Monitor\PingMonitorJob;
use Illuminate\Console\Command;
use MarioDevv\Uptime\Monitoring\Domain\MonitorRepository;

class PingMonitorsCommand extends Command
{

    protected $signature = 'ping:monitors';
    protected $description = 'Ping all monitors to check if they are up or down';

    public function handle(): void
    {
        $monitors = app(MonitorRepository::class)->all();

        foreach ($monitors as $monitor) {
            PingMonitorJob::dispatch($monitor->id());
        }
    }
}
