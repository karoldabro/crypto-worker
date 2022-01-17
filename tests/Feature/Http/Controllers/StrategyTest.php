<?php

namespace Kdabrow\CryptoWorker\Tests\Feature\Http\Controllers;

use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorker\Models\User;
use Kdabrow\CryptoWorker\Models\Strategy;
class StrategyTest extends TestCase
{
    /** @test */
    public function it_response_in_correct_structure_after_create_strategy()
    {
        $this->actingAs(User::factory()->create());
       
        $strategy =Strategy::factory()->make()->toArray();

        $this->json('POST', 'api/v1/strategies', $strategy)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'kandle_interval',
                'refresh_interval', 
            ]);

        $this->assertDatabaseHas('strategies', [
                'name' => $strategy['name'],
                'kandle_interval' => $strategy['kandle_interval'],
                'refresh_interval' => $strategy['refresh_interval'], 
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_strategy_list()
    {
        $this->actingAs(User::factory()->create());

       Strategy::factory()->count(2)->create();

        $this->json('GET', 'api/v1/strategies')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                       [
                              'id',
                              'name',
                              'kandle_interval',
                              'refresh_interval', 
                       ]
                ],
                'links',
                'meta'
            ]);
    }
    
    /** @test */
    public function it_response_in_correct_structure_after_update_strategy()
    {
        $this->actingAs(User::factory()->create());

        $strategy = Strategy::factory()->create();

        $data = Strategy::factory()->make()->toArray();

        $this->json('PUT', 'api/v1/strategies/'.$strategy->id, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'kandle_interval',
                'refresh_interval', 
            ]);

        $this->assertDatabaseHas('strategies', [
            'id' => $strategy->id,
            'name' => $data['name'],
            'kandle_interval' => $data['kandle_interval'],
            'refresh_interval' => $data['refresh_interval'], 
        ]);
    }
    
    /** @test */
    public function it_response_in_correct_structure_in_show_endpoint_strategy()
    {
        $this->actingAs(User::factory()->create());

        $strategy = Strategy::factory()->create();

        $this->json('GET', 'api/v1/strategies/'.$strategy->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'kandle_interval',
                'refresh_interval', 
            ]);
    }
    
    /** @test */
    public function it_response_in_correct_status_after_delete_strategy()
    {
        $this->actingAs(User::factory()->create());

        $strategy = Strategy::factory()->create();

        $this->json('DELETE', 'api/v1/strategies/'.$strategy->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('strategies', [
            'id' => $strategy->id
        ]);
    }

    /** @test */
    public function it_response_in_correct_status_when_strategy_is_not_found_to_delete()
    {
        $this->actingAs(User::factory()->create());

        $strategy = Strategy::factory()->create();

        $this->json('DELETE', 'api/v1/strategies/'.$strategy->id.'1')
            ->assertStatus(404);
    }
}