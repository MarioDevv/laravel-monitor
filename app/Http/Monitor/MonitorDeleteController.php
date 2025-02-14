<?php

namespace App\Http\Monitor;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use MarioDevv\Uptime\Monitor\Application\Delete\DeleteMonitor;
use MarioDevv\Uptime\Monitor\Application\Delete\DeleteMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;
use Throwable;

class MonitorDeleteController
{

    private DeleteMonitor $deleteMonitor;

    public function __construct()
    {
        $this->deleteMonitor = new DeleteMonitor(
            app(MonitorRepository::class),
        );
    }

    public function __invoke(int $id): RedirectResponse
    {
        try {

            ($this->deleteMonitor)(new DeleteMonitorRequest($id));

            return redirect()->route('monitors.index');

        } catch (Throwable $th) {
            Log::error($th->getMessage() . 'Line: ' . $th->getLine() . 'File: ' . $th->getFile());
            return back()->with('error', 'Server Error');
        }
    }

}
