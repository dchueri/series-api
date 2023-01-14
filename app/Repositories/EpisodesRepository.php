<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface EpisodesRepository
{
    public function getAllOfSeason(int $seasonId);
    public function updateIfWasWatched(int $episodeId, Request $request): bool;
}