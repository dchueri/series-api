<?php

namespace Tests\Feature;

use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SeriesControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all()
    {
        $series = Series::factory(3)->afterCreating(function ($series) {
            $series->orderBy('name');
        })->create();
        $response = $this->get('/api/series');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJson(function (AssertableJson $json) use ($series) {
            $json->whereAllType([
                '0.id' => 'integer',
                '0.name' => 'string'
            ]);
            $json->hasAll(['0.id', '0.name']);
            $json->missingAll('0.seasons');

            $firstSeries = $series->first();
            $json->whereAll([
                '0.name' => $firstSeries->name,
            ]);
        });
    }
}
