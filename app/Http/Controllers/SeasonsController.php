<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Repositories\SeasonsRepository;

class SeasonsController extends Controller
{
    public function __construct(private SeasonsRepository $seasonsRepository)
    {
    }

    public function index(int $seriesId)
    {
        $seasons = $this->seasonsRepository->getAllOfSeries($seriesId);

        return response($seasons, 200);
    }
}