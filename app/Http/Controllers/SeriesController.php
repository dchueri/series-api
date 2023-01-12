<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Models\Episode;
use App\Models\Series;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::all();

        return $series;
    }

    public function store(SeriesFormRequest $request)
    {
        $series = Series::create($request->all());
        $seasons = [];
        for ($i = 1; $i <= $request->seasonsNumber; $i++) {
            $seasons[] = [
                'series_id' => $series->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($series->seasons as $season) {
            for ($j = 1; $j < $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        Episode::insert($episodes);

        return response()->json($series, 201);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return response()->json($series, 200);
    }

    public function destroy(string $series)
    {
        Series::destroy($series);
        return response('', 204);
    }
}