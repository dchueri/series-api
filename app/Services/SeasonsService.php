<?php

namespace App\Services;

use App\Repositories\SeasonsRepository;

class SeasonsService
{
    public function __construct(private SeasonsRepository $seasonsRepository)
    {
    }

    public function getAllOfSeries(int $seriesId)
    {
        $seasons = $this->seasonsRepository->getAllOfSeries($seriesId);

        return $seasons;
    }
}