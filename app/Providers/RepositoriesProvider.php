<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use App\Repositories\EloquentEpisodesRepository;
use App\Repositories\EpisodesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class,
        EpisodesRepository::class => EloquentEpisodesRepository::class
    ];
}
