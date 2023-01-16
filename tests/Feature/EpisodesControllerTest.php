<?php

namespace Tests\Feature;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EpisodeControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_all_episodes_of_an_season()
    {
        Series::factory(1)->has(Season::factory(1)->has(Episode::factory((3))))->createOne();
        $response = $this->getJson('/api/seasons/1/episodes');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                '0.id' => 'integer',
                '0.number' => 'integer',
                '0.season_id' => 'integer',
                '0.watched' => 'boolean'
            ]);
            $json->hasAll(['0.id', '0.number', '0.season_id', '0.watched']);
        });
    }

    public function test_get_all_episodes_should_validate_if_provide_an_invalid_seasonsId()
    {
        $response = $this->getJson('/api/seasons/5/episodes');

        $response->assertStatus(404);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'episodes with informed seasonId not found'
            ]);
        });
    }

    public function test_post_episodes()
    {
        Series::factory(1)->has(Season::factory(3))->create();
        $response = $this->postJson('/api/seasons/1/episodes', ['numberOfEpisodes' => 3]);

        $response->assertStatus(201);

        $episodes = Episode::where('season_id', 1)->get();

        $this->assertEquals(3, sizeof($episodes));
        $this->assertIsInt($episodes[0]->id);
        $this->assertIsInt($episodes[0]->number);
    }

    public function test_post_episodes_should_validate_when_try_create_without_number_of_episodes()
    {
        $response = $this->postJson('/api/seasons/1/episodes', []);

        $response->assertStatus(422);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'numberOfEpisodes is required'
            ]);
        });
    }

    public function test_post_episodes_should_validate_if_provide_an_invalid_seasonId()
    {
        $response = $this->postJson('/api/seasons/5/episodes', ['numberOfEpisodes' => 1]);

        $response->assertStatus(404);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'seasonId not found'
            ]);
        });
    }

    public function test_update_if_episode_was_watched()
    {
        Series::factory(1)->has(Season::factory(1)->has(Episode::factory((3))))->createOne();

        $episode = Episode::where('id', 1)->first();
        $this->assertEquals(false, $episode->watched);

        $response = $this->patchJson('/api/episodes/1', ['watched' => true]);
        $response->assertStatus(204);

        $episodeWatched = Episode::where('id', 1)->first();
        $this->assertEquals(true, $episodeWatched->watched);
    }

    public function test_update_if_episode_was_watched_should_validate_if_provide_an_invalid_episodeId()
    {
        $response = $this->patchJson('/api/episodes/1', ['watched' => true]);

        $response->assertStatus(404);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereAllType([
                'message' => 'string'
            ]);
            $json->hasAll(['message']);
            $json->whereAll([
                'message' => 'episodeId not found'
            ]);
        });
    }
}
