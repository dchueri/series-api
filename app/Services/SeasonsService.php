<?php

namespace App\Services;

use App\Repositories\SeasonsRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class SeasonsService
{
    public function __construct(private SeasonsRepositoryContract $seasonsRepository)
    {
    }

    public function getAllOfSeries(int $seriesId): Collection
    {
        $seasons = $this->seasonsRepository->getAllOfSeries($seriesId);

        return $seasons;
    }

    public function add(int $seriesId, int $seasonsNumber)
    {
        $numberOfLastSeason = $this->seasonsRepository->getLastSeason($seriesId);
        $seasonsArray = [];
        for ($i = 1; $i <= $seasonsNumber; $i++) {
            $seasonsArray[] = [
                'series_id' => $seriesId,
                'number' => $i + $numberOfLastSeason,
            ];
        }

        $this->seasonsRepository->addMultipleSeasons($seasonsArray);
    }
}
