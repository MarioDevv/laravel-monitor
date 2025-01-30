<?php

namespace App\Http\Monitor\Assemblers;

use App\Http\Monitor\DTOs\PaginatedMonitorDTO;
use MarioDevv\Uptime\Monitor\Application\MonitorAssemblerInterface;
use MarioDevv\Uptime\Monitor\Domain\Monitor;

class PaginatedMonitorAssembler implements MonitorAssemblerInterface
{

    public function assemble(Monitor $monitor, ...$args): PaginatedMonitorDTO
    {
        return new PaginatedMonitorDTO($monitor, ...$args);
    }

}
