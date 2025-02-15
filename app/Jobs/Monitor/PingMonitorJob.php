<?php

namespace App\Jobs\Monitor;

use App\Doctrine\Repository\Monitor\CurlPingService;
use App\Doctrine\Repository\Monitor\LaravelMailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitor;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class PingMonitorJob implements ShouldQueue
{
    use Queueable;

    private int $monitorId;

    public function __construct(int $monitorId)
    {
        $this->monitorId = $monitorId;
    }

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $pingMonitor = new PingMonitor(
            app(MonitorRepository::class),
            new CurlPingService(),
            new LaravelMailService()
        );

        ($pingMonitor)(new PingMonitorRequest($this->monitorId));
    }
}
