<?php

namespace App\Repositories;

use App\Models\Season;
use App\Repositories\SeasonsRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

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

    public function getLastSeason(): int
    {
        return Season::max('number');
    }
}
