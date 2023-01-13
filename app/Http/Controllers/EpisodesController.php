<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodesWatchedFormRequest;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function index(int $seasonId)
    {
        $episodes = Episode::query()
            ->where('season_id', $seasonId)
            ->get();

        return response($episodes, 200);
    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = $request->watchedEpisodes;
        $notWatchedEpisodes = $request->notWatchedEpisodes;
        DB::transaction(function () use ($watchedEpisodes, $notWatchedEpisodes) {
            if ($watchedEpisodes) {
                DB::table('episodes')->whereIn('id', $watchedEpisodes)->update(['watched' => true]);
            }
            if ($notWatchedEpisodes) {
                DB::table('episodes')->whereIn('id', $notWatchedEpisodes)->update(['watched' => false]);
            }
        });

        return response('', 200);
    }
}