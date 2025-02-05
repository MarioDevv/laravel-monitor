<?php

namespace App\Http\Monitor\Client;

use App\Http\Monitor\Assemblers\MonitorDTOAssembler;
use App\Http\Monitor\Assemblers\PaginatedMonitorAssembler;
use App\Http\Monitor\DTOs\PaginatedMonitorDTO;
use CodelyTv\Criteria\Criteria;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use MarioDevv\Uptime\Monitor\Application\Search\SearchMonitors;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class MonitorsViewController
{

    private SearchMonitors $searchMonitors;

    public function __construct()
    {
        $this->searchMonitors = new SearchMonitors(
            app(MonitorRepository::class),
            new MonitorDTOAssembler(PaginatedMonitorDTO::class)
        );
    }

    public function __invoke(): Application|Factory|View
    {

        $array = ($this->searchMonitors)(Criteria::withFilters([]));

        $monitors = array_map(fn(PaginatedMonitorDTO $monitor) => $monitor->json(), $array);

        return view('monitors.index', compact('monitors'));
    }

}
