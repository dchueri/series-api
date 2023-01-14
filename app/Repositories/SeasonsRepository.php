<?php

namespace App\Repositories;

interface SeasonsRepository
{
    public function getAllOfSeries(int $seriesId);
}