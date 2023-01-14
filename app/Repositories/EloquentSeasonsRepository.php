<?php

namespace App\Repositories;

use App\Models\Season;
use App\Repositories\SeasonsRepository;

class EloquentSeasonsRepository implements SeasonsRepository
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