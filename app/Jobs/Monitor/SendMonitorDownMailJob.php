<?php

namespace App\Jobs\Monitor;

use App\Mail\Monitor\MonitorDownMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use MarioDevv\Uptime\Monitoring\Domain\Monitor;

class SendMonitorDownMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Monitor $monitor;

    public function __construct(Monitor $monitor)
    {
        $this->monitor = $monitor;
    }

    public function handle(): void
    {
        Mail::to(env('MAIL_TEST_USER', 'fallback@example.com'))
            ->send(
                new MonitorDownMail(
                    $this->monitor->url()->value()
                )
            );
    }
}
