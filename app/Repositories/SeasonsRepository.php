<?php

namespace App\Repositories;

use App\Models\Season;

class SeasonsRepository implements SeasonsRepositoryContract
{
    public function getAllOfSeries(int $seriesId)
    {
        $seasons = Season::query()
            ->with('episodes')
            ->where('series_id', $seriesId)
            ->get();

        return $seasons;
    }
}
