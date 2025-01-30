<?php

namespace App\Http\Monitor\Assemblers;

use App\Http\Monitor\DTOs\CompleteMonitorDTO;
use MarioDevv\Uptime\Monitor\Application\MonitorAssemblerInterface;
use MarioDevv\Uptime\Monitor\Domain\Monitor;

class CompleteMonitorAssembler implements MonitorAssemblerInterface
{
    public function assemble(Monitor $monitor, ...$args): CompleteMonitorDTO
    {
        return new CompleteMonitorDTO($monitor, ...$args);
    }
}
