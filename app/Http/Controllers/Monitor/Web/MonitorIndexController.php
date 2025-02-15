<?php

namespace App\Http\Controllers\Monitor\Web;

use App\Http\Controllers\Monitor\Assemblers\MonitorDTOAssembler;
use App\Http\Controllers\Monitor\DTOs\PaginatedMonitorDTO;
use CodelyTv\Criteria\Criteria;
use CodelyTv\Criteria\FilterOperator;
use CodelyTv\Criteria\InvalidCriteria;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MarioDevv\Criteria\CriteriaFromUrlConverter;
use MarioDevv\Uptime\Monitor\Application\Count\CountMonitors;
use MarioDevv\Uptime\Monitor\Application\Delete\DeleteMonitor;
use MarioDevv\Uptime\Monitor\Application\Delete\DeleteMonitorRequest;
use MarioDevv\Uptime\Monitor\Application\Search\SearchMonitors;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;
use MarioDevv\Uptime\Monitor\Domain\MonitorState;
use Throwable;

class MonitorIndexController
{

    private SearchMonitors $searchMonitors;
    private CountMonitors $countMonitors;
    private DeleteMonitor $deleteMonitor;
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

        $this->deleteMonitor = new DeleteMonitor(
            app(MonitorRepository::class),
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

            $query['pageSize']   = $query['pageSize'] ?? 10;
            $query['pageNumber'] = $query['pageNumber'] ?? 1;

            return redirect()->route('monitors.index', $query);
        }


        $criteria = $this->criteriaFromUrlConverter->toCriteria($request->fullUrl());

        $array   = ($this->searchMonitors)($criteria);
        $count   = ($this->countMonitors)($criteria);
        $summary = $this->statusSummary();

        $monitors = array_map(fn(PaginatedMonitorDTO $monitor) => $monitor->json(), $array);

        return view('web.admin.monitors.index', compact('monitors', 'count', 'summary'));
    }


    public function delete(int $id): View|Application|Factory|RedirectResponse
    {
        try {

            ($this->deleteMonitor)(new DeleteMonitorRequest($id));

            return redirect()->route('monitors.index');

        } catch (Throwable $th) {
            Log::error($th->getMessage() . 'Line: ' . $th->getLine() . 'File: ' . $th->getFile());
            return back()->with('error', 'Error while deleting');
        }
    }


    /**
     * Gets Up, Down, Stopped & Total Monitors
     * @throws InvalidCriteria
     */
    private function statusSummary(): array
    {


        $up = ($this->countMonitors)(Criteria::withFilters(
            [[
                 'field'    => 'state',
                 'operator' => FilterOperator::EQUAL->value,
                 'value'    => (string)MonitorState::UP
             ]]
        ));

        $down = ($this->countMonitors)(Criteria::withFilters(
            [[
                 'field'    => 'state',
                 'operator' => FilterOperator::EQUAL->value,
                 'value'    => (string)MonitorState::DOWN
             ]]
        ));

        $stopped = ($this->countMonitors)(Criteria::withFilters(
            [[
                 'field'    => 'state',
                 'operator' => FilterOperator::EQUAL->value,
                 'value'    => (string)MonitorState::STOPPED
             ]]
        ));

        $total = ($this->countMonitors)(Criteria::withFilters([]));

        return [
            'up'      => $up,
            'down'    => $down,
            'stopped' => $stopped,
            'use'     => ($up + $down),
            'total'   => $total
        ];
    }

}
