<?php

namespace Tests\Feature;

use App\Dto\SeriesCreateDto;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepositoryContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testWhenGetAllSeriesAndReturnASeriesList()
    {
        $repository = $this->app->make(SeriesRepositoryContract::class);
        $seriesCreateData = new SeriesCreateDto('Name of series');

        $repository->add($seriesCreateData);
        
        $series = $repository->getAll();
        $this->assertNotEmpty($series);
    }
}
