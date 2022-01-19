<?php

namespace Kdabrow\CryptoWorker\Tests\Http\Controllers;

use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorker\Models\User;
use Kdabrow\CryptoWorker\Models\ActiveStrategy;

class ActiveStrategyTest extends TestCase
{
    /** @test */
    public function it_response_in_correct_structure_after_create_activestrategy()
    {
        $this->actingAs(User::factory()->create());

        $activestrategy = ActiveStrategy::factory()->make()->toArray();

        $this->json('POST', 'api/v1/active_strategies', $activestrategy)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'strategy_id',
                'exchange_id',
                'pair',
                'kline_interval',
                'kline_quantity',
                'refresh_interval',
            ]);

        $this->assertDatabaseHas('active_strategies', [
            'strategy_id' => $activestrategy['strategy_id'],
            'exchange_id' => $activestrategy['exchange_id'],
            'pair' => $activestrategy['pair'],
            'kline_interval' => $activestrategy['kline_interval'],
            'kline_quantity' => $activestrategy['kline_quantity'],
            'refresh_interval' => $activestrategy['refresh_interval'],
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_activestrategy_list()
    {
        $this->actingAs(User::factory()->create());

        ActiveStrategy::factory()->create();

        $this->json('GET', 'api/v1/active_strategies')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'strategy_id',
                        'exchange_id',
                        'pair',
                        'kline_interval',
                        'kline_quantity',
                        'refresh_interval',
                    ]
                ],
                'links',
                'meta'
            ]);
    }

    /** @test */
    public function it_response_in_correct_structure_after_update_activestrategy()
    {
        $this->actingAs(User::factory()->create());

        $activestrategy = ActiveStrategy::factory()->create();

        $data = ActiveStrategy::factory()->make()->toArray();

        $this->json('PUT', 'api/v1/active_strategies/' . $activestrategy->id, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'strategy_id',
                'exchange_id',
                'pair',
                'kline_interval',
                'kline_quantity',
                'refresh_interval',
            ]);

        $this->assertDatabaseHas('active_strategies', [
            'id' => $activestrategy->id,
            'strategy_id' => $data['strategy_id'],
            'exchange_id' => $data['exchange_id'],
            'pair' => $data['pair'],
            'kline_interval' => $data['kline_interval'],
            'kline_quantity' => $data['kline_quantity'],
            'refresh_interval' => $data['refresh_interval'],
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_show_endpoint_activestrategy()
    {
        $this->actingAs(User::factory()->create());

        $activestrategy = ActiveStrategy::factory()->create();

        $this->json('GET', 'api/v1/active_strategies/' . $activestrategy->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'strategy_id',
                'exchange_id',
                'pair',
                'kline_interval',
                'kline_quantity',
                'refresh_interval',
            ]);
    }

    /** @test */
    public function it_response_in_correct_status_after_delete_activestrategy()
    {
        $this->actingAs(User::factory()->create());

        $activestrategy = ActiveStrategy::factory()->create();

        $this->json('DELETE', 'api/v1/active_strategies/' . $activestrategy->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('active_strategies', [
            'id' => $activestrategy->id
        ]);
    }

    /** @test */
    public function it_response_in_correct_status_when_activestrategy_is_not_found_to_delete()
    {
        $this->actingAs(User::factory()->create());

        $activestrategy = ActiveStrategy::factory()->create();

        $this->json('DELETE', 'api/v1/active_strategies/' . $activestrategy->id . '1')
            ->assertStatus(404);
    }
}
