<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
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
        $seriesName = $request->name;

        $series = new Series();
        $series->name = $seriesName;
        $series->save();

        return response()->json($series, 201);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return response()->json($series, 200);
    }

    public function destroy(String $series)
    {
        Series::destroy($series);
        return response('', 204);
    }
}
