<?php

namespace Tests\Feature;

use App\Models\Series;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SeasonsControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_seasons_of_an_series()
    {
        Series::factory(1)->has(Season::factory(3))->createOne();
        $response = $this->getJson('/api/series/1/seasons');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                '0.id' => 'integer',
                '0.number' => 'integer',
                '0.episodes' => 'array'
            ]);
            $json->hasAll(['0.id', '0.number', '0.episodes']);
        });
    }

    public function test_post_season()
    {
        Series::factory(1)->create();
        $response = $this->postJson('/api/series/1/seasons', ['numberOfSeasons' => 3]);

        $response->assertStatus(201);

        $series = Season::where('series_id', 1)->get();

        $this->assertEquals(3, sizeof($series));
        $this->assertIsInt($series[0]->id);
        $this->assertIsInt($series[0]->number);
    }

    public function test_post_season_should_validate_when_try_create_without_number_of_seasons()
    {
        $response = $this->postJson('/api/series/1/seasons', []);

        $response->assertStatus(422);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'numberOfSeasons is required'
            ]);
        });
    }

    public function test_post_season_should_validate_if_provide_an_invalid_seriesId()
    {
        $response = $this->putJson('/api/series' . '/5', ['name' => 'Updated']);

        $response->assertStatus(404);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'seriesId not found'
            ]);
        });
    }
}
