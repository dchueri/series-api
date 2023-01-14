<?php

namespace App\Repositories;

use App\Models\Episode;
use Illuminate\Http\Request;

class EloquentEpisodesRepository implements EpisodesRepository
{
    public function getAllOfSeason(int $seasonId)
    {
        $episodes = Episode::query()
            ->where('season_id', $seasonId)
            ->get();

        return $episodes;
    }

    public function updateIfWasWatched(int $episodeId, Request $request): void
    {
        Episode::where('id', $episodeId)->update($request->all());
    }
}