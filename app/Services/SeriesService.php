<?php

namespace App\Services;

use App\Models\Series;
use App\Repositories\SeriesRepositoryContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Dto\SeriesCreateDto;
use App\Dto\SeriesUpdateDto;

class SeriesService
{
    public function __construct(private SeriesRepositoryContract $seriesRepository)
    {
    }

    public function getAll()
    {
        return $this->seriesRepository->getAll();
    }

    public function getOneById(int $seriesId): Series
    {
        $series = $this->seriesRepository->getOneById($seriesId);
        if (!$series) {
            throw new ModelNotFoundException("seriesId not found");
        }
        return $series;
    }

    public function add(string $seriesName): Series
    {
        $seriesToCreate = new SeriesCreateDto($seriesName);
        return $this->seriesRepository->add($seriesToCreate);
    }

    public function update(int $seriesId, string $seriesName): void
    {
        $seriesToUpdate = new SeriesUpdateDto($seriesName);
        $updated = $this->seriesRepository->update($seriesId, $seriesToUpdate);
        if (!$updated) {
            throw new ModelNotFoundException("seriesId not found");
        }
    }

    public function delete(int $seriesId): void
    {
        $deleted = $this->seriesRepository->delete($seriesId);
        if (!$deleted) {
            throw new ModelNotFoundException("seriesId not found");
        }
    }
}
