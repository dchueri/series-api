<?php

namespace App\Repositories;

interface SeasonsRepositoryContract
{
    public function getAllOfSeries(int $seriesId);
}