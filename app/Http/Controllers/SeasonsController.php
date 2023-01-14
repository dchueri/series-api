<?php

namespace App\Http\Controllers;

use App\Services\SeasonsService;
use Illuminate\Http\Client\Request;
use App\Http\Requests\SeasonsCreateFormRequest;

class SeasonsController extends Controller
{
    public function __construct(private SeasonsService $seasonsService)
    {
    }

    public function index(int $seriesId)
    {
        $seasons = $this->seasonsService->getAllOfSeries($seriesId);

        return response($seasons, 200);
    }

    public function store(int $seriesId, SeasonsCreateFormRequest $request)
    {
        $this->seasonsService->add($seriesId, $request->numberOfSeasons);
    }
}
