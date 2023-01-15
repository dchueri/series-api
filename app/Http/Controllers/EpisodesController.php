<?php

namespace App\Http\Controllers;

use App\Services\EpisodesService;
use App\Http\Requests\EpisodesCreateFormRequest;
use App\Http\Requests\EpisodeUpdateWatchedFormRequest;

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

    public function update(int $episode, EpisodeUpdateWatchedFormRequest $request)
    {
        $this->episodesService->updateIfWasWatched($episode, $request);

        return response()->noContent();
    }

    public function store(int $seasonId, EpisodesCreateFormRequest $request)
    {
        $this->episodesService->add($seasonId, $request->numberOfEpisodes);
    }
}
