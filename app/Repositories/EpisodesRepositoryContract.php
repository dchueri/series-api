<?php

namespace App\Repositories;

use App\Dto\EpisodeUpdateDto;

interface EpisodesRepositoryContract
{
    public function getAllOfSeason(int $seasonId);
    public function updateIfWasWatched(int $episodeId, EpisodeUpdateDto $episodeUpdatedData): bool;
    public function addMultipleEpisodes(array $episodes): void;
    public function getLastEpisodeNumber(int $seasonId): int | null;
}
