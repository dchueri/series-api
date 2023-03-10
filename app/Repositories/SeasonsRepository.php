<?php

namespace App\Repositories;

use App\Models\Season;
use App\Repositories\SeasonsRepositoryContract;
use Illuminate\Support\Collection;

class SeasonsRepository implements SeasonsRepositoryContract
{
    public function getAllOfSeries(int $seriesId): Collection
    {
        $seasons = Season::query()
            ->with('episodes')
            ->where('series_id', $seriesId)
            ->get();

        return $seasons;
    }

    public function addMultipleSeasons(array $seasons): void
    {
        Season::insert($seasons);
    }

    public function getLastSeasonNumber(int $seriesId): int | null
    {
        return Season::where('series_id', $seriesId)->max('number');
    }

    public function getOneById(int $seasonId): Season | null
    {
        return Season::where('id', $seasonId)->with('episodes')->first();
    }
}
