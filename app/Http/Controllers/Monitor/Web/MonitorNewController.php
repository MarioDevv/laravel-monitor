<?php

namespace App\Http\Controllers\Monitor\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use MarioDevv\Uptime\Monitoring\Application\Create\CreateMonitor;
use MarioDevv\Uptime\Monitoring\Application\Create\CreateMonitorRequest;
use Throwable;

class MonitorNewController extends Controller
{
    private CreateMonitor $createMonitor;


    public function __construct(CreateMonitor $createMonitor)
    {
        $this->createMonitor = $createMonitor;
    }

    public function __invoke(Request $request): RedirectResponse
    {
        try {

            $this->validate($request, [
                'monitor_type' => 'required',
                'url'          => 'required',
                'interval'     => 'required',
                'timeout'      => 'required',
            ]);

            $interval = $this->convertToInterval(
                $request->input('interval')
            );

            $timeout = $this->convertToTimeOut(
                $request->input('timeout')
            );

            ($this->createMonitor)
            (new CreateMonitorRequest(
                 $request->input('url'),
                 $interval,
                 $timeout
             ));

            return redirect()->route('monitors.index');

        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        } catch (Throwable $th) {
            Log::error($th->getMessage() . 'Line: ' . $th->getLine() . 'File: ' . $th->getFile());
            return back()->with('error', 'Server Error');
        }

    }

    private function convertToInterval(int $interval): int
    {
        return match ($interval) {
            0 => 30,
            1 => 60,
            2 => 300,
        };

    }

    private function convertToTimeOut(int $timeout): int
    {
        return match ($timeout) {
            0 => 5,
            1 => 10,
            2 => 45,
            3 => 60
        };
    }

}
