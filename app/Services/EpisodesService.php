<?php

namespace App\Services;

use App\Repositories\EpisodesRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EpisodesService
{
    public function __construct(private EpisodesRepository $episodesRepository)
    {
    }

    public function getAllOfSeason(int $seasonId)
    {
        $episodes = $this->episodesRepository->getAllOfSeason($seasonId);

        if (!sizeof($episodes)) {
            throw new ModelNotFoundException(" Season {$seasonId}");
        }

        return $episodes;
    }
    public function updateIfWasWatched(int $episodeId, Request $request): void
    {
        $updated = $this->episodesRepository->updateIfWasWatched($episodeId, $request);

        if (!$updated) {
            throw new ModelNotFoundException(" Episode {$episodeId}");
        }
    }
}