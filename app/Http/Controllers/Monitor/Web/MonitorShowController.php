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
use MarioDevv\Uptime\Monitoring\Application\Find\FindMonitor;
use MarioDevv\Uptime\Monitoring\Application\Find\FindMonitorRequest;
use MarioDevv\Uptime\Monitoring\Application\Ping\PingMonitor;
use MarioDevv\Uptime\Monitoring\Application\Ping\PingMonitorRequest;
use MarioDevv\Uptime\Monitoring\Domain\MonitorRepository;
use MarioDevv\Uptime\Monitoring\Application\Resume\ResumeMonitor;
use MarioDevv\Uptime\Monitoring\Application\Resume\ResumeMonitorRequest;
use MarioDevv\Uptime\Monitoring\Application\Stop\StopMonitor;
use MarioDevv\Uptime\Monitoring\Application\Stop\StopMonitorRequest;
use MarioDevv\Uptime\Monitoring\Domain\MonitorNotFoundException;
use Throwable;

class MonitorShowController extends Controller
{

    private FindMonitor   $findMonitor;
    private PingMonitor   $pingMonitor;
    private StopMonitor   $stopMonitor;
    private ResumeMonitor $resumeMonitor;

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

        $this->stopMonitor = new StopMonitor(
            app(MonitorRepository::class)
        );

        $this->resumeMonitor = new ResumeMonitor(
            app(MonitorRepository::class)
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


    public function stop(Request $request)
    {

        try {

            ($this->stopMonitor)
            (new StopMonitorRequest((int)$request->id));

            return back();

        } catch (MonitorNotFoundException $e) {
            Log::error($e->getMessage() . ' File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            return back()->with('error', 'Something went wrong');

        } catch (Throwable $th) {
            Log::error($th->getMessage() . ' File: ' . $th->getFile() . ' Line: ' . $th->getLine());
            return back()->with('error', 'Something went wrong');
        }

    }


    public function resume(Request $request)
    {

        try {

            ($this->resumeMonitor)
            (new ResumeMonitorRequest((int)$request->id));

            return back();

        } catch (MonitorNotFoundException $e) {
            Log::error($e->getMessage() . ' File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            return back()->with('error', 'Something went wrong');

        } catch (Throwable $th) {
            Log::error($th->getMessage() . ' File: ' . $th->getFile() . ' Line: ' . $th->getLine());
            return back()->with('error', 'Something went wrong');
        }
    }

}
