<?php

namespace App\Http\Monitor\Client;

use App\Http\Controllers\Controller;
use App\Http\Monitor\Assemblers\CompleteMonitorAssembler;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use MarioDevv\Uptime\Monitor\Application\Find\FindMonitor;
use MarioDevv\Uptime\Monitor\Application\Find\FindMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class MonitorViewController extends Controller
{

    private FindMonitor $findMonitor;

    public function __construct()
    {
        $this->findMonitor = new FindMonitor(
            app(MonitorRepository::class),
            new CompleteMonitorAssembler()
        );
    }


    /**
     * @throws \Exception
     */
    public function __invoke(int $id): View|Factory|Application
    {
        $monitor = ($this->findMonitor)(new FindMonitorRequest($id));

        $formattedMonitor = $monitor->json();

        return view('monitors.show', compact('formattedMonitor'));
    }


}
