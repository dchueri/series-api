<?php

namespace App\Http\Controllers;

use App\Repositories\EpisodesRepository;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{

    public function __construct(private EpisodesRepository $episodeRepository)
    {
    }

    public function index(int $seasonId)
    {
        $episodes = $this->episodeRepository->getAllOfSeason($seasonId);

        return response()->json($episodes, 200);
    }

    public function update(int $episode, Request $request)
    {
        $this->episodeRepository->updateIfWasWatched($episode, $request);

        return response()->noContent();
    }
}