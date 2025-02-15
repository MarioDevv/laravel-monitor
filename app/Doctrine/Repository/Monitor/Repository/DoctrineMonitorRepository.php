<?php

namespace App\Doctrine\Repository\Monitor\Repository;

use App\Doctrine\DoctrineRepository;
use CodelyTv\Criteria\Criteria;
use MarioDevv\Criteria\CriteriaToDoctrineConverter;
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

    public function matching(Criteria $criteria): array
    {
        $criteriaToDoctrineFields = [
            'url' => 'url.value'
        ];

        $doctrineCriteria = (new CriteriaToDoctrineConverter($criteriaToDoctrineFields))->convert($criteria);

        return $this->repository(Monitor::class)->matching($doctrineCriteria)->toArray();
    }

    public function count(Criteria $criteria): int
    {
        $criteriaToDoctrineFields = [
            'url'   => 'url.value',
            'state' => 'state.value'
        ];

        $doctrineCriteria = (new CriteriaToDoctrineConverter($criteriaToDoctrineFields))->convert($criteria);

        return $this->repository(Monitor::class)->matching($doctrineCriteria)->count();
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
