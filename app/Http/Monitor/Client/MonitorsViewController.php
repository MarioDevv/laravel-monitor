<?php

namespace App\Http\Monitor\Client;

use App\Http\Monitor\Assemblers\MonitorDTOAssembler;
use App\Http\Monitor\DTOs\PaginatedMonitorDTO;
use CodelyTv\Criteria\Criteria;
use CodelyTv\Criteria\InvalidCriteria;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MarioDevv\Criteria\CriteriaFromUrlConverter;
use MarioDevv\Uptime\Monitor\Application\Count\CountMonitors;
use MarioDevv\Uptime\Monitor\Application\Search\SearchMonitors;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class MonitorsViewController
{

    private SearchMonitors           $searchMonitors;
    private CountMonitors            $countMonitors;
    private CriteriaFromUrlConverter $criteriaFromUrlConverter;

    public function __construct()
    {
        $this->searchMonitors = new SearchMonitors(
            app(MonitorRepository::class),
            new MonitorDTOAssembler(PaginatedMonitorDTO::class)
        );

        $this->countMonitors = new CountMonitors(
            app(MonitorRepository::class)
        );

        $this->criteriaFromUrlConverter = new CriteriaFromUrlConverter();
    }

    /**
     * @throws InvalidCriteria
     */
    public function __invoke(Request $request): View|Application|Factory|RedirectResponse
    {

        if (!$request->has('pageSize') || !$request->has('pageNumber')) {
            $query = $request->query();

            $query['pageSize'] = $query['pageSize'] ?? 10;
            $query['pageNumber'] = $query['pageNumber'] ?? 1;

            return redirect()->route('monitors.index', $query);
        }


        $criteria = $this->criteriaFromUrlConverter->toCriteria($request->fullUrl());

        $array = ($this->searchMonitors)($criteria);
        $count = ($this->countMonitors)($criteria);

        $monitors = array_map(fn(PaginatedMonitorDTO $monitor) => $monitor->json(), $array);

        return view('web.admin.monitors.index', compact('monitors', 'count'));
    }


}
