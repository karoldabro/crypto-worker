<?php

namespace Kdabrow\CryptoWorker\Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Kdabrow\CryptoWorker\Models\Kline;
use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorker\Models\User;

class KlineTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_response_in_correct_structure_after_create_kline()
    {
        $this->actingAs(User::factory()->create());
       
        $kline = Kline::factory()->make()->toArray();

        $this->json('POST', 'api/v1/klines', $kline)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'symbol',
                'exchange_id',
                'timestamp',
                'interval',
                'open',
                'high',
                'low',
                'close',
                'volume',
                'indicators',
                'other_data', 
            ]);

        $this->assertDatabaseHas('klines', [
           'symbol' => $kline['symbol'],
           'exchange_id' => $kline['exchange_id'],
           'timestamp' => $kline['timestamp'],
           'interval' => $kline['interval'],
           'open' => $kline['open'],
           'high' => $kline['high'],
           'low' => $kline['low'],
           'close' => $kline['close'],
           'volume' => $kline['volume'],
        //    'indicators' => $kline['indicators'],
        //    'other_data' => $kline['other_data'],
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_kline_list()
    {
        $this->actingAs(User::factory()->create());

       Kline::factory()->create();

        $this->json('GET', 'api/v1/klines')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                       [
                              'id',
                              'symbol',
                              'exchange_id',
                              'timestamp',
                              'interval',
                              'open',
                              'high',
                              'low',
                              'close',
                              'volume',
                              'indicators',
                              'other_data', 
                       ]
                ],
                'links',
                'meta'
            ]);
    }
    
    /** @test */
    public function it_response_in_correct_structure_after_update_kline()
    {
        $this->actingAs(User::factory()->create());

        $kline = Kline::factory()->create();

        $data = Kline::factory()->make()->toArray();

        $this->json('PUT', 'api/v1/klines/'.$kline->id, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'symbol',
                'exchange_id',
                'timestamp',
                'interval',
                'open',
                'high',
                'low',
                'close',
                'volume',
                'indicators',
                'other_data', 
            ]);

        $this->assertDatabaseHas('klines', [
            'id' => $kline->id,           
            'symbol' => $data['symbol'],           
            'exchange_id' => $data['exchange_id'],           
            'timestamp' => $data['timestamp'],           
            'interval' => $data['interval'],           
            'open' => $data['open'],           
            'high' => $data['high'],           
            'low' => $data['low'],           
            'close' => $data['close'],           
            'volume' => $data['volume'],           
            // 'indicators' => $data['indicators'],           
            // 'other_data' => $data['other_data'],
        ]);
    }
    
    /** @test */
    public function it_response_in_correct_structure_in_show_endpoint_kline()
    {
        $this->actingAs(User::factory()->create());

        $kline = Kline::factory()->create();

        $this->json('GET', 'api/v1/klines/'.$kline->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'symbol',
                'exchange_id',
                'timestamp',
                'interval',
                'open',
                'high',
                'low',
                'close',
                'volume',
                'indicators',
                'other_data', 
            ]);
    }
    
    /** @test */
    public function it_response_in_correct_status_after_delete_kline()
    {
        $this->actingAs(User::factory()->create());

        $kline = Kline::factory()->create();

        $this->json('DELETE', 'api/v1/klines/'.$kline->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('klines', [
            'id' => $kline->id
        ]);
    }

    /** @test */
    public function it_response_in_correct_status_when_kline_is_not_found_to_delete()
    {
        $this->actingAs(User::factory()->create());

        $kline = Kline::factory()->create();

        $this->json('DELETE', 'api/v1/klines/'.$kline->id.'1')
            ->assertStatus(404);
    }
}