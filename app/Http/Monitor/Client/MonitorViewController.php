<?php

namespace App\Http\Monitor\Client;

use CodelyTv\Criteria\Criteria;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use MarioDevv\Uptime\Monitor\Application\PaginatedMonitorAssembler;
use MarioDevv\Uptime\Monitor\Application\Search\PaginatedMonitorDTO;
use MarioDevv\Uptime\Monitor\Application\Search\SearchMonitors;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class MonitorViewController
{

    private SearchMonitors $searchMonitors;

    public function __construct()
    {
        $this->searchMonitors = new SearchMonitors(
            app(MonitorRepository::class),
            new PaginatedMonitorAssembler()
        );
    }

    public function __invoke(): Application|Factory|View
    {

        $monitors = ($this->searchMonitors)(Criteria::withFilters([]));

        $mappedMonitors = array_map(fn(PaginatedMonitorDTO $monitor) => $monitor->json(), $monitors);


        return view('monitors.index', compact('mappedMonitors'));
    }

}
