<?php

namespace App\Repositories;

use App\Dto\SeriesCreateDto;
use App\Dto\SeriesUpdateDto;
use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\SeriesRepositoryContract;

class SeriesRepository implements SeriesRepositoryContract
{
    public function getAll(): Collection
    {
        return Series::all();
    }

    public function getOneById(int $seriesId): Series | null
    {
        $series = Series::where('id', $seriesId)->with('seasons.episodes')->first();
        return $series;
    }

    public function add(SeriesCreateDto $seriesData): Series
    {
        $series = Series::create($seriesData->array);
        return $series;
    }

    public function update(Series $series, SeriesUpdateDto $seriesUpdatedData): Series
    {
        $series->update($seriesUpdatedData->array);
        return $series;
    }

    public function delete(int $seriesId): bool
    {
        return Series::destroy($seriesId);
    }
}
