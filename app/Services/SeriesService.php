<?php

namespace App\Services;

use App\Http\Requests\SeriesUpdateFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepositoryContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return $this->seriesRepository->getOneById($seriesId);
    }

    public function add(string $seriesName): Series
    {
        return $this->seriesRepository->add($seriesName);
    }

    public function update(int $seriesId, SeriesUpdateFormRequest $request): void
    {
        $updated = $this->seriesRepository->update($seriesId, $request);
        if (!$updated) {
            throw new ModelNotFoundException(" Series {$seriesId}");
        }
    }

    public function delete(int $seriesId): void
    {
        $deleted = $this->seriesRepository->delete($seriesId);
        if (!$deleted) {
            throw new ModelNotFoundException(" Series {$seriesId}");
        }
    }
}
