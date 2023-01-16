<?php

namespace App\Services;

use App\Models\Season;
use App\Repositories\SeasonsRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\SeriesService;

class SeasonsService
{

    public function __construct(private SeasonsRepositoryContract $seasonsRepository, private SeriesService $seriesService)
    {
    }

    public function getAllOfSeries(int $seriesId): Collection
    {
        $seasons = $this->seasonsRepository->getAllOfSeries($seriesId);
        if (!sizeof($seasons)) {
            throw new ModelNotFoundException('seasons with informed seriesId not found');
        }

        return $seasons;
    }

    public function getOneById(int $seasonId): Season
    {
        $season = $this->seasonsRepository->getOneById($seasonId);
        if (!$season) {
            throw new ModelNotFoundException("seasonId not found");
        }
        return $season;
    }

    public function add(int $seriesId, int $seasonsNumber): void
    {
        $this->seriesService->getOneById($seriesId);
        $numberOfLastSeason = $this->seasonsRepository->getLastSeasonNumber($seriesId);
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
