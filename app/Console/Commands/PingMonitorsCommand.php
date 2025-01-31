<?php

namespace App\Console\Commands;

use App\Doctrine\Repository\Monitor\CurlPingService;
use Illuminate\Console\Command;
use MarioDevv\Uptime\Monitor\Application\Check\CheckMonitors;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class PingMonitorsCommand extends Command
{

    private CheckMonitors $checkMonitors;

    public function __construct()
    {
        parent::__construct();
        $this->checkMonitors = new CheckMonitors(
            app(MonitorRepository::class),
            new CurlPingService()
        );
    }

    protected $signature = 'ping:monitors';

    protected $description = 'Ping all monitors to check if they are up or down';

    public function handle(): void
    {
        ($this->checkMonitors)();
    }
}
