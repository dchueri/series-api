<?php

namespace App\Repositories;

use App\Dto\EpisodeUpdateDto;
use App\Models\Episode;

class EpisodesRepository implements EpisodesRepositoryContract
{
    public function getAllOfSeason(int $seasonId)
    {
        $episodes = Episode::query()
            ->where('season_id', $seasonId)
            ->get();

        return $episodes;
    }

    public function updateIfWasWatched(int $episodeId, EpisodeUpdateDto $episodeUpdatedData): bool
    {
        return Episode::where('id', $episodeId)->update($episodeUpdatedData->array);
    }

    public function addMultipleEpisodes(array $episodes): void
    {
        Episode::insert($episodes);
    }

    public function getLastEpisodeNumber(int $seasonId): int | null
    {
        return Episode::where('season_id', $seasonId)->max('number');
    }
}
