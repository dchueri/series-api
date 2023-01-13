<?php

namespace App\Http\Controllers;

use App\Models\Season;

class SeasonsController extends Controller
{
    public function index(int $seriesId)
    {
        $seasons = Season::query()
            ->with('episodes')
            ->where('series_id', $seriesId)
            ->get();

        return response($seasons, 200);
    }
}
