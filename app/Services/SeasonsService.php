<?php

namespace App\Services;

use App\Repositories\SeasonsRepositoryContract;

class SeasonsService
{
    public function __construct(private SeasonsRepositoryContract $seasonsRepository)
    {
    }

    public function getAllOfSeries(int $seriesId)
    {
        $seasons = $this->seasonsRepository->getAllOfSeries($seriesId);

        return $seasons;
    }
}