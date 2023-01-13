<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\SeriesUpdateFormRequest;
use App\Models\Series;
use Illuminate\Support\Collection;

interface SeriesRepository
{
    public function getAll();
    public function getOneById(int $seriesId): series;
    public function add(SeriesFormRequest $request): Series;
    public function update(int $seriesId, SeriesUpdateFormRequest $request): void;
    public function delete(int $seriesId): void;
}