<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface EpisodesRepositoryContract
{
    public function getAllOfSeason(int $seasonId);
    public function updateIfWasWatched(int $episodeId, Request $request): bool;
    public function addMultipleEpisodes(array $episodes): void;
    public function getLastEpisodeNumber(int $seasonId): int | null;
}
