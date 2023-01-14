<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepositoryContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function testWhenGetAllSeriesAndReturnASeriesList()
    {
        $repository = $this->app->make(SeriesRepositoryContract::class);
        $request = new SeriesFormRequest([
            'name' => 'Name of series',
            'seasonsNumber' => 1,
            'episodesPerSeason' => 1
        ]);

        $repository->add($request);
        
        $series = $repository->getAll();
        $this->assertNotEmpty($series);
    }

    public function testWhenASeriesIsCreatedItsSeasonsAndEpisodesMustAlsoBeCreated()
    {
        $repository = $this->app->make(SeriesRepositoryContract::class);
        $request = new SeriesFormRequest([
            'name' => 'Name of series',
            'seasonsNumber' => 1,
            'episodesPerSeason' => 1
        ]);

        $repository->add($request);

        $this->assertDatabaseHas('series', ['name' => 'Name of series']);
        $this->assertDataBaseHas('seasons', ['number' => 1]);
        $this->assertDataBaseHas('episodes', ['number' => 1]);
    }
}
