<?php

namespace App\Http\Controllers\Monitor\Assemblers;

use MarioDevv\Uptime\Monitoring\Application\MonitorAssemblerInterface;
use MarioDevv\Uptime\Monitoring\Domain\Monitor;

class MonitorDTOAssembler implements MonitorAssemblerInterface
{

    private string $dtoClass;

    public function __construct(string $dtoClass)
    {
        $this->dtoClass = $dtoClass;
    }

    public function assemble(Monitor $monitor, ...$args): mixed
    {
        return new $this->dtoClass($monitor, $args);
    }

}
