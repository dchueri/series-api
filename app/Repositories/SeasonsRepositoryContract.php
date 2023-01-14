<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Season;

interface SeasonsRepositoryContract
{
    public function getAllOfSeries(int $seriesId): Collection;
    public function addMultipleSeasons(array $series): void;
    public function getLastSeason(): int;
}
