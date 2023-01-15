<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface SeasonsRepositoryContract
{
    public function getAllOfSeries(int $seriesId): Collection;
    public function addMultipleSeasons(array $series): void;
    public function getLastSeasonNumber(int $seriesId): int;
}
