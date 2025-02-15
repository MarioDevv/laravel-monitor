<?php

namespace App\Http\Controllers\Monitor\Web;

use App\Doctrine\Repository\Monitor\CurlPingService;
use App\Doctrine\Repository\Monitor\LaravelMailService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Monitor\Assemblers\MonitorDTOAssembler;
use App\Http\Controllers\Monitor\DTOs\CompleteMonitorDTO;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MarioDevv\Uptime\Monitor\Application\Find\FindMonitor;
use MarioDevv\Uptime\Monitor\Application\Find\FindMonitorRequest;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitor;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;
use Throwable;

class MonitorShowController extends Controller
{

    private FindMonitor $findMonitor;
    private PingMonitor $pingMonitor;

    public function __construct()
    {
        $this->findMonitor = new FindMonitor(
            app(MonitorRepository::class),
            new MonitorDTOAssembler(CompleteMonitorDTO::class)
        );

        $this->pingMonitor = new PingMonitor(
            app(MonitorRepository::class),
            new CurlPingService(),
            new LaravelMailService()
        );
    }


    /**
     * @throws Exception
     */
    public function __invoke(int $id): View|Factory|Application
    {
        $monitor = ($this->findMonitor)(new FindMonitorRequest($id));

        $formattedMonitor = $monitor->json();

        return view('web.admin.monitors.show', compact('formattedMonitor'));
    }


    public function ping(Request $request)
    {
        try {

            ($this->pingMonitor)
            (new PingMonitorRequest((int)$request->id));

            return back();

        } catch (Throwable $th) {
            Log::error($th->getMessage() . ' File: ' . $th->getFile() . ' Line: ' . $th->getLine());
            return back()->with('error', 'Something went wrong');
        }
    }

}
