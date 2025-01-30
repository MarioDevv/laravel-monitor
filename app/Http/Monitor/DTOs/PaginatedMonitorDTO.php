<?php

namespace App\Http\Monitor\DTOs;

use MarioDevv\Uptime\Monitor\Domain\Monitor;

class PaginatedMonitorDTO
{

    private int $id;
    private string $friendlyName;
    private string $url;
    private int $status;
    private ?string $lastCheck;

    public function __construct(Monitor $monitor, ...$args)
    {
        $this->id           = $monitor->id();
        $this->friendlyName = $this->friendlyName($monitor->url()->value());
        $this->url          = $monitor->url()->value();
        $this->status       = $monitor->state()->value();
        $this->lastCheck    = $monitor->lastCheck()->format();
    }

    private function friendlyName(string $value): string
    {
        $array = explode('//', $value);
        return $array[1];
    }

    public function json(): array
    {
        return [
            'id'           => $this->id,
            'friendlyName' => $this->friendlyName,
            'url'          => $this->url,
            'status'       => $this->status,
            'lastCheck'    => $this->lastCheck,
        ];

    }


}
