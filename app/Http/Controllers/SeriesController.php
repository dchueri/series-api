<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\SeriesUpdateFormRequest;
use App\Services\SeriesService;


class SeriesController extends Controller
{
    public function __construct(private SeriesService $seriesService)
    {
    }

    public function index()
    {
        $series = $this->seriesService->getAll();

        return response()->json($series);
    }

    public function show(int $seriesId)
    {
        $seriesFounded = $this->seriesService->getOneById($seriesId);
        return response()->json($seriesFounded);
    }

    public function store(SeriesFormRequest $request)
    {
        $series = $this->seriesService->add($request->name);

        return response()->json($series, 201);
    }

    public function update(int $seriesId, SeriesUpdateFormRequest $request)
    {
        $this->seriesService->update($seriesId, $request);
        return response()->json(['message' => "series with id {$seriesId} updated"]);
    }

    public function destroy(int $series)
    {
        $this->seriesService->delete($series);
        return response()->noContent();
    }
}
