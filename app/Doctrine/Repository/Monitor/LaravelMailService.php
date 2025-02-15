<?php

namespace App\Doctrine\Repository\Monitor;

use App\Jobs\Monitor\SendMonitorDownMailJob;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorNotifier;

class LaravelMailService implements MonitorNotifier
{
    public function notify(Monitor $monitor): void
    {
        SendMonitorDownMailJob::dispatch($monitor);
    }

}
