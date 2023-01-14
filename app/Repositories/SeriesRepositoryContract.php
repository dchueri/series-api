<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\SeriesUpdateFormRequest;
use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;

interface SeriesRepositoryContract
{
    /**
     * Summary of getAll
     * @return Collection
     */
    public function getAll(): Collection;
    public function getOneById(int $seriesId): Series;
    public function add(SeriesFormRequest $request): Series;
    public function update(int $seriesId, SeriesUpdateFormRequest $request): bool;
    public function delete(int $seriesId): bool;
}
