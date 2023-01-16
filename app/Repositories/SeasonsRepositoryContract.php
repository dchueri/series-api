<?php

namespace App\Repositories;

use App\Models\Season;
use Illuminate\Support\Collection;

interface SeasonsRepositoryContract
{
    public function getAllOfSeries(int $seriesId): Collection;
    public function getOneById(int $seriesId): Season | null;
    public function addMultipleSeasons(array $series): void;
    public function getLastSeasonNumber(int $seriesId): int | null;
}
