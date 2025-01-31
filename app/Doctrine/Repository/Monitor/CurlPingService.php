<?php

namespace App\Doctrine\Repository\Monitor;

use MarioDevv\Uptime\Monitor\Domain\MonitorPingInformation;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorTimeOut;
use MarioDevv\Uptime\Monitor\Domain\MonitorUrl;

class CurlPingService implements MonitorPingService
{

    public function ping(MonitorUrl $url, MonitorTimeOut $timeout): MonitorPingInformation
    {
        $ch = curl_init($url->value());

        $responseTime = microtime(true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout->value());

        curl_exec($ch);

        $responseTime = microtime(true) - $responseTime;

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return new MonitorPingInformation($this->getState($httpCode), $responseTime);
    }

    private function getState(int $httpCode): int
    {
        if ($httpCode >= 200 && $httpCode < 400) {
            return 1;
        }

        return 2;
    }


}
