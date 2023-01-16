<?php

namespace App\Repositories;

use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;
use App\Dto\SeriesCreateDto;
use App\Dto\SeriesUpdateDto;

interface SeriesRepositoryContract
{
    /**
     * Summary of getAll
     * @return Collection
     */
    public function getAll(): Collection;
    public function getOneById(int $seriesId): Series | null;
    public function add(SeriesCreateDto $seriesData): Series;
    public function update(Series $series, SeriesUpdateDto $seriesUpdatedData): Series;
    public function delete(int $seriesId): bool;
}
