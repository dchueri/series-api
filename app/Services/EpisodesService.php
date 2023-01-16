<?php

namespace App\Services;

use App\Dto\EpisodeUpdateDto;
use App\Models\Season;
use App\Repositories\EpisodesRepositoryContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EpisodesService
{
    public function __construct(private EpisodesRepositoryContract $episodesRepository, private SeasonsService $seasonsService)
    {
    }

    public function getAllOfSeason(int $seasonId)
    {
        $episodes = $this->episodesRepository->getAllOfSeason($seasonId);

        if (!sizeof($episodes)) {
            throw new ModelNotFoundException("episodes with informed seasonId not found");
        }

        return $episodes;
    }

    public function updateIfWasWatched(int $episodeId, bool $episodeWatched): void
    {
        $episodeUpdatedData = new EpisodeUpdateDto($episodeWatched);
        $updated = $this->episodesRepository->updateIfWasWatched($episodeId, $episodeUpdatedData);

        if (!$updated) {
            throw new ModelNotFoundException("episodeId not found");
        }
    }

    public function add(int $seasonId, int $numberOfEpisodes)
    {
        $this->seasonsService->getOneById($seasonId);
        $numberOfLastEpisode = $this->episodesRepository->getLastEpisodeNumber($seasonId);
        $episodes = [];
        for ($i = 1; $i <= $numberOfEpisodes; $i++) {
            $episodes[] = [
                'season_id' => $seasonId,
                'number' => $i + $numberOfLastEpisode
            ];
        }

        $this->episodesRepository->addMultipleEpisodes($episodes);
    }
}
