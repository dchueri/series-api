<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Models\Episode;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    public function index()
    {
        $series = Series::all();

        return $series;
    }

    public function store(SeriesFormRequest $request)
    {
        $series = $this->seriesRepository->add($request);

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