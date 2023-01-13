<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\SeriesUpdateFormRequest;
use App\Repositories\SeriesRepository;


class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    public function index()
    {
        $series = $this->seriesRepository->getAll();

        return response()->json($series);
    }

    public function show(int $series)
    {
        $seriesFounded = $this->seriesRepository->getOneById($series);
        return response()->json($seriesFounded);
    }

    public function store(SeriesFormRequest $request)
    {
        $series = $this->seriesRepository->add($request);

        return response()->json($series, 201);
    }

    public function update(int $seriesId, SeriesUpdateFormRequest $request)
    {
        $this->seriesRepository->update($seriesId, $request);
        return response()->json("{'message': 'series with id {$seriesId} updated'}");
    }

    public function destroy(int $series)
    {
        $this->seriesRepository->delete($series);
        return response()->noContent();
    }
}