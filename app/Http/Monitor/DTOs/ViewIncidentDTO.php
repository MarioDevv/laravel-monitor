<?php

namespace App\Http\Monitor\DTOs;

use MarioDevv\Uptime\Monitor\Domain\MonitorHistory;

class ViewIncidentDTO
{

    private int $httpStatusCode;
    private int $status;
    private string $at;
    private float $responseTime;

    public function __construct(MonitorHistory $incident)
    {
        $this->httpStatusCode = $incident->httpStatusCode();
        $this->status         = $incident->state()->value();
        $this->at             = $incident->pingedAt()->format('m-d H:i');
        $this->responseTime   = $incident->responseTime();
    }

    public function json(): array
    {
        return [
            'httpStatus'   => $this->httpStatusCode,
            'status'       => $this->status,
            'at'           => $this->at,
            'responseTime' => $this->responseTime,
        ];
    }
}
