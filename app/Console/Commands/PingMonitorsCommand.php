<?php

namespace App\Console\Commands;

use App\Doctrine\Repository\Monitor\CurlPingService;
use App\Jobs\PingMonitorJob;
use Illuminate\Console\Command;
use MarioDevv\Uptime\Monitor\Application\Check\CheckMonitors;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

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
