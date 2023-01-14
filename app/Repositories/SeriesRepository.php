<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\SeriesUpdateFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Repositories\SeriesRepositoryContract;

class SeriesRepository implements SeriesRepositoryContract
{
    public function getAll(): Collection
    {
        return Series::all();
    }

    public function getOneById(int $seriesId): Series
    {
        return Series::findOrFail($seriesId)->with('seasons.episodes')->first();
    }

    public function add(SeriesFormRequest $form): Series
    {
        return DB::transaction(function () use ($form) {

            $series = Series::create($form->all());
            $seasons = [];
            for ($i = 1; $i <= $form->seasonsNumber; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);

            $episodes = [];
            foreach ($series->seasons as $season) {
                for ($j = 1; $j <= $form->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);

            return $series;
        });
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
