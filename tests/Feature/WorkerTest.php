<?php

namespace Kdabrow\CryptoWorker\Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorker\Models\User;
use Kdabrow\CryptoWorker\Models\Worker;
class WorkerTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_response_in_correct_structure_after_create_worker()
    {
        $this->actingAs(User::factory()->create());
       
        $worker =Worker::factory()->make()->toArray();

        $this->json('POST', 'api/v1/workers', $worker)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'strategy_id',
                'exchange_id',
                'pair',
                'kandle_interval',
                'refresh_interval', 
            ]);

        $this->assertDatabaseHas('workers', [
                'strategy_id' => $worker['strategy_id'],
                'exchange_id' => $worker['exchange_id'],
                'pair' => $worker['pair'],
                'kandle_interval' => $worker['kandle_interval'],
                'refresh_interval' => $worker['refresh_interval'], 
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_worker_list()
    {
        $this->actingAs(User::factory()->create());

       Worker::factory()->count(2)->create();

        $this->json('GET', 'api/v1/workers')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                       [
                              'id',
                              'strategy_id',
                              'exchange_id',
                              'pair',
                              'kandle_interval',
                              'refresh_interval', 
                       ]
                ],
                'links',
                'meta'
            ]);
    }
    
    /** @test */
    public function it_response_in_correct_structure_after_update_worker()
    {
        $this->actingAs(User::factory()->create());

        $worker = Worker::factory()->create();

        $data = Worker::factory()->make()->toArray();

        $this->json('PUT', 'api/v1/workers/'.$worker->id, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'strategy_id',
                'exchange_id',
                'pair',
                'kandle_interval',
                'refresh_interval', 
            ]);

        $this->assertDatabaseHas('workers', [
            'id' => $worker->id,
            'strategy_id' => $data['strategy_id'],
            'exchange_id' => $data['exchange_id'],
            'pair' => $data['pair'],
            'kandle_interval' => $data['kandle_interval'],
            'refresh_interval' => $data['refresh_interval'], 
        ]);
    }
    
    /** @test */
    public function it_response_in_correct_structure_in_show_endpoint_worker()
    {
        $this->actingAs(User::factory()->create());

        $worker = Worker::factory()->create();

        $this->json('GET', 'api/v1/workers/'.$worker->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'strategy_id',
                'exchange_id',
                'pair',
                'kandle_interval',
                'refresh_interval', 
            ]);
    }
    
    /** @test */
    public function it_response_in_correct_status_after_delete_worker()
    {
        $this->actingAs(User::factory()->create());

        $worker = Worker::factory()->create();

        $this->json('DELETE', 'api/v1/workers/'.$worker->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('workers', [
            'id' => $worker->id
        ]);
    }

    /** @test */
    public function it_response_in_correct_status_when_worker_is_not_found_to_delete()
    {
        $this->actingAs(User::factory()->create());

        $worker = Worker::factory()->create();

        $this->json('DELETE', 'api/v1/workers/'.$worker->id.'1')
            ->assertStatus(404);
    }
}