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
    public function test_get_all_series()
    {
        Series::factory(3)->afterCreating(function ($series) {
            $series->orderBy('name');
        })->create();
        $response = $this->getJson('/api/series');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                '0.id' => 'integer',
                '0.name' => 'string'
            ]);
            $json->hasAll(['0.id', '0.name']);
            $json->missingAll('0.seasons');
        });
    }

    public function test_get_one_series()
    {
        $series = Series::factory(1)->createOne();
        $response = $this->getJson('/api/series' . '/1');
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) use ($series) {
            $json->whereAllType([
                'id' => 'integer',
                'name' => 'string',
                'seasons' => 'array',
            ]);
            $json->hasAll(['id', 'name', 'seasons', 'created_at', 'updated_at']);

            $json->whereAll([
                'id' => $series->id,
                'name' => $series->name,
                'seasons' => $series->seasons,
            ]);
        });
    }

    public function test_get_one_series_should_validate_if_provide_an_invalid_seriesId()
    {
        $response = $this->getJson('/api/series' . '/5');
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

    public function test_post_series()
    {
        $series = Series::factory(1)->makeOne();
        $response = $this->postJson('/api/series', $series->toArray());
        $createdSeries = $response->getOriginalContent();

        $response->assertStatus(201);
        $response->assertJson(function (AssertableJson $json) use ($createdSeries) {
            $json->whereAllType([
                'id' => 'integer',
                'name' => 'string',
            ]);
            $json->hasAll(['id', 'name', 'created_at', 'updated_at']);
            $json->whereAll([
                'id' => $createdSeries->id,
                'name' => $createdSeries->name,
            ]);
        });
    }

    public function test_post_series_should_validate_when_try_create_without_name()
    {
        $response = $this->postJson('/api/series', []);

        $response->assertStatus(422);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'name is required'
            ]);
        });
    }

    public function test_post_series_should_validate_when_try_create_with_invalid_name()
    {
        $response = $this->postJson('/api/series', ['name' => 1]);

        $response->assertStatus(422);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'name must be a string'
            ]);
        });
    }

    public function test_update_series()
    {
        $series = Series::factory(1)->createOne();
        $response = $this->putJson('/api/series' . '/1', ['name' => 'Updated']);
        $updatedSeries = $response->getOriginalContent();

        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) use ($series, $updatedSeries) {
            $json->whereAllType([
                'id' => 'integer',
                'name' => 'string',
                'seasons' => 'array'
            ]);
            $json->hasAll(['id', 'name', 'created_at', 'updated_at']);
            $json->whereAll([
                'id' => $series->id,
                'name' => $updatedSeries->name,
                'seasons' => $series->seasons,
            ]);
            $json->whereNot('name', $series->name);
        });
    }

    public function test_update_series_should_validate_if_provide_an_invalid_seriesId()
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

    public function test_update_series_should_validate_when_try_update_without_name()
    {
        $response = $this->putJson('/api/series' . '/5', []);

        $response->assertStatus(422);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'name is required'
            ]);
        });
    }

    public function test_delete_series()
    {
        Series::factory(1)->createOne();

        $response = $this->get('/api/series');

        $response->assertJsonCount(1);

        $deleteResponse = $this->deleteJson('/api/series/1');

        $deleteResponse->assertStatus(204);

        $newResponse = $this->get('/api/series');
        $newResponse->assertJsonCount(0);
    }

    public function test_delete_series_should_validate_if_provide_an_invalid_seriesId()
    {
        $response = $this->deleteJson('/api/series/1');

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
