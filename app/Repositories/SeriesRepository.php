<?php

namespace App\Repositories;

use App\Http\Requests\SeriesUpdateFormRequest;
use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\SeriesRepositoryContract;

class SeriesRepository implements SeriesRepositoryContract
{
    public function getAll(): Collection
    {
        return Series::all();
    }

    public function getOneById(int $seriesId): Series
    {
        $series = Series::where('id', $seriesId)->with('seasons.episodes')->firstOrFail();
        return $series;
    }

    public function add(string $seriesName): Series
    {
        $seriesToCreate = [
            'name' => $seriesName
        ];
        $series = Series::create($seriesToCreate);

        return $series;
    }

    public function update(int $seriesId, SeriesUpdateFormRequest $form): bool
    {
        return Series::where('id', $seriesId)->update($form->all());
    }

    public function delete(int $seriesId): bool
    {
        return Series::destroy($seriesId);
    }
}
