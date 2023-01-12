<?php

namespace App\Repositories;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

interface SeriesRepository
{
    public function add(SeriesFormRequest $request): Series;
}