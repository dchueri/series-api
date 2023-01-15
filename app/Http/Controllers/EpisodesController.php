<?php

namespace App\Http\Controllers;

use App\Services\EpisodesService;
use App\Http\Requests\EpisodesCreateMultipleRequest;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{

    public function __construct(private EpisodesService $episodesService)
    {
    }

    public function index(int $seasonId)
    {
        $episodes = $this->episodesService->getAllOfSeason($seasonId);

        return response()->json($episodes, 200);
    }

    public function update(int $episode, Request $request)
    {
        $this->episodesService->updateIfWasWatched($episode, $request);

        return response()->noContent();
    }
    
    public function store(int $seasonId, EpisodesCreateMultipleRequest $request)
    {
        $this->episodesService->add($seasonId, $request->numberOfEpisodes);
    }
}