<?php

namespace App\Http\Controllers\Monitor\DTOs;

use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorHistory;

class CompleteMonitorDTO
{

    private int $id;

    private string  $friendlyName;
    private string  $url;
    private int     $status;
    private int     $interval;
    private ?string $lastCheck;
    private ?string $sslExpiration;
    private float   $responseTimeAvg;
    private float   $responseTimeMax;
    private float   $responseTimeMin;
    private array   $history;

    public function __construct(Monitor $monitor, ...$args)
    {
        $this->id              = $monitor->id();
        $this->friendlyName    = $this->friendlyName($monitor->url()->value());
        $this->url             = $monitor->url()->value();
        $this->status          = $monitor->state()->value();
        $this->interval        = $monitor->interval()->value();
        $this->lastCheck       = $monitor->lastCheck()->format('d/m/Y H:i');
        $this->sslExpiration   = $monitor->sslExpiration()->format('d F Y');
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
            'sslExpiration'   => $this->sslExpiration,
            'responseTimeAvg' => round($this->responseTimeAvg, 2),
            'responseTimeMax' => round($this->responseTimeMax, 2),
            'responseTimeMin' => round($this->responseTimeMin, 2),
            'incidents'       => $this->getIncidentHistory(),
        ];
    }

    private function friendlyName(string $value): string
    {
        $array = explode('//', $value);
        return $array[1];
    }

    public function getIncidentHistory(): array
    {
        $historyArray = $this->history;

        usort($historyArray, fn(ViewIncidentDTO $a, ViewIncidentDTO $b) => $b->json()['at'] <=> $a->json()['at']);

        return array_map(fn(ViewIncidentDTO $history) => $history->json(), $historyArray);
    }
}
