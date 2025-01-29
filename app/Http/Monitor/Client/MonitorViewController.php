<?php

namespace App\Http\Monitor\Client;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class MonitorViewController
{

    private MonitorRepository $repository;

    public function __construct(MonitorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): Application|Factory|View
    {
        $monitors = $this->repository->all();
        return view('monitors', compact('monitors'));
    }

}
