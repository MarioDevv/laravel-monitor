<?php

namespace App\Http\Monitor;

use App\Doctrine\Repository\Monitor\CurlPingService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitor;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class MonitorPostPingController extends Controller
{

    private PingMonitor $pingMonitor;

    public function __construct()
    {
        $this->pingMonitor = new PingMonitor(
            app(MonitorRepository::class),
            new CurlPingService()
        );
    }

    public function __invoke(Request $request)
    {
        try {

            ($this->pingMonitor)
            (new PingMonitorRequest(
                 (int)$request->id
             ));

            return back();

        } catch (\Throwable $th) {
            Log::error($th->getMessage() . ' File: ' . $th->getFile() . ' Line: ' . $th->getLine());
            return back()->with('error', 'Something went wrong');
        }
    }

}
