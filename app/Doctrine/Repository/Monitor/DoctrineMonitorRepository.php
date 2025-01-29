<?php

namespace App\Doctrine\Repository\Monitor;

use App\Doctrine\DoctrineRepository;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class DoctrineMonitorRepository extends DoctrineRepository implements MonitorRepository
{
    public function nextIdentity(): int
    {
        $last = $this->repository(Monitor::class)->findOneBy([], ['id' => 'DESC']);
        return $last ? $last->id() + 1 : 1;
    }

    public function all(): array
    {
        return $this->repository(Monitor::class)->findAll();
    }

    public function byId(int $id): ?Monitor
    {
        return $this->repository(Monitor::class)->find($id);
    }

    public function save(Monitor $monitor): void
    {
        $this->persist($monitor);
    }

    public function delete(Monitor $monitor): void
    {
        $this->remove($monitor);
    }


}
