<?php

namespace App\Providers;

use App\Repositories\SeriesRepository;
use App\Repositories\SeasonsRepository;
use App\Repositories\SeasonsRepositoryContract;
use App\Repositories\SeriesRepositoryContract;
use App\Repositories\EpisodesRepository;
use App\Repositories\EpisodesRepositoryContract;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        SeriesRepositoryContract::class => SeriesRepository::class,
        SeasonsRepositoryContract::class => SeasonsRepository::class,
        EpisodesRepositoryContract::class => EpisodesRepository::class
    ];
}
