<?php

namespace App\Doctrine\Repository\Monitor;

use App\Jobs\Monitor\SendMonitorDownMailJob;
use MarioDevv\Uptime\Monitoring\Domain\Monitor;
use MarioDevv\Uptime\Monitoring\Domain\MonitorNotifier;

class LaravelMailService implements MonitorNotifier
{
    public function notify(Monitor $monitor): void
    {
        SendMonitorDownMailJob::dispatch($monitor);
    }

}
