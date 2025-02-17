<?php

namespace App\Doctrine\Repository\Monitor;

use DateTimeImmutable;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingInformation;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorTimeOut;
use MarioDevv\Uptime\Monitor\Domain\MonitorUrl;

class CurlPingService implements MonitorPingService
{
    public function ping(MonitorUrl $url, MonitorTimeOut $timeout): MonitorPingInformation
    {
        $ch = curl_init($url->value());

        $start = microtime(true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout->value());

        $result       = curl_exec($ch);
        $responseTime = microtime(true) - $start;


        if ($result === false || curl_errno($ch)) {
            curl_close($ch);
            return new MonitorPingInformation(
                504,
                $responseTime,
                null
            );
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $sslExpiration = null;
        if (str_starts_with($url->value(), 'https://')) {
            $sslExpiration = $this->getSslExpirationDate($url->value(), $timeout->value());
        }

        return new MonitorPingInformation(
            $httpCode,
            $responseTime,
            $sslExpiration
        );
    }

    private function getSslExpirationDate(string $rawUrl, float $timeout): ?DateTimeImmutable
    {
        $host = parse_url($rawUrl, PHP_URL_HOST);
        if (!$host) {
            return null;
        }

        $port = parse_url($rawUrl, PHP_URL_PORT) ?: 443;

        $context = stream_context_create([
            'ssl' => [
                'capture_peer_cert' => true,
            ],
        ]);

        $fp = @stream_socket_client(
            "ssl://$host:$port",
            $errno,
            $errstr,
            $timeout,
            STREAM_CLIENT_CONNECT,
            $context
        );

        if (!$fp) {
            return null;
        }

        $params = stream_context_get_params($fp);
        fclose($fp);

        $cert = $params['options']['ssl']['peer_certificate'] ?? null;
        if (!$cert) {
            return null;
        }

        $certInfo = openssl_x509_parse($cert);
        if (!$certInfo || !isset($certInfo['validTo_time_t'])) {
            return null;
        }

        return new DateTimeImmutable('@' . $certInfo['validTo_time_t']);
    }
}
