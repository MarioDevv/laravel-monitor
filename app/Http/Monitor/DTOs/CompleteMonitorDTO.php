<?php

namespace App\Http\Monitor\DTOs;

use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorHistory;

class CompleteMonitorDTO
{

    private int $id;

    private string $friendlyName;
    private string $url;
    private int $status;
    private int $interval;
    private ?string $lastCheck;
    private float $responseTimeAvg;
    private float $responseTimeMax;
    private float $responseTimeMin;
    private array $history;

    public function __construct(Monitor $monitor, ...$args)
    {
        $this->id              = $monitor->id();
        $this->friendlyName    = $this->friendlyName($monitor->url()->value());
        $this->url             = $monitor->url()->value();
        $this->status          = $monitor->state()->value();
        $this->interval        = $monitor->interval()->value();
        $this->lastCheck       = $monitor->lastCheck()->format();
        $this->responseTimeAvg = $monitor->responseTimeAvg();
        $this->responseTimeMax = $monitor->responseTimeMax();
        $this->responseTimeMin = $monitor->responseTimeMin();
        $this->history         = array_map(fn(MonitorHistory $incident) => new ViewIncidentDTO($incident), $monitor->history());

    }


    public function json(): array
    {
        return [
            'id'              => $this->id,
            'friendlyName'    => $this->friendlyName,
            'url'             => $this->url,
            'status'          => $this->status,
            'interval'        => $this->interval,
            'lastCheck'       => $this->lastCheck,
            'responseTimeAvg' => $this->responseTimeAvg,
            'responseTimeMax' => $this->responseTimeMax,
            'responseTimeMin' => $this->responseTimeMin,
            'incidents'       => array_map(fn(ViewIncidentDTO $incident) => $incident->json(), $this->history),
        ];
    }

    private function friendlyName(string $value): string
    {
        $array = explode('//', $value);
        return $array[1];
    }
}
