<?php

namespace Kdabrow\CryptoWorker\Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorker\Models\Order;
use Kdabrow\CryptoWorker\Models\User;

class OrderTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_response_in_correct_structure_after_create_order()
    {
        $this->actingAs(User::factory()->create());
       
        $order = Order::factory()->make()->toArray();

        $this->json('POST', 'api/v1/orders', $order)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'external_id',
                'active_strategy_id',
                'strategy_id',
                'exchange_id',
                'status',
                'symbol',
                'type',
                'side',
                'price',
                'quantity',
                'activation_price',
                'stop_loss',
                'registered_at',
                'executed_at',
                'closed_at', 
            ]);

        $this->assertDatabaseHas('orders', [
           'external_id' => $order['external_id'],
           'active_strategy_id' => $order['active_strategy_id'],
           'strategy_id' => $order['strategy_id'],
           'exchange_id' => $order['exchange_id'],
           'status' => $order['status'],
           'symbol' => $order['symbol'],
           'type' => $order['type'],
           'side' => $order['side'],
           'price' => $order['price'],
           'quantity' => $order['quantity'],
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_order_list()
    {
        $this->actingAs(User::factory()->create());

       Order::factory()->create();

        $this->json('GET', 'api/v1/orders')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                       [
                              'id',
                              'external_id',
                              'active_strategy_id',
                              'strategy_id',
                              'exchange_id',
                              'status',
                              'symbol',
                              'type',
                              'side',
                              'price',
                              'quantity',
                              'activation_price',
                              'stop_loss',
                              'registered_at',
                              'executed_at',
                              'closed_at', 
                       ]
                ],
                'links',
                'meta'
            ]);
    }
    
    /** @test */
    public function it_response_in_correct_structure_after_update_order()
    {
        $this->actingAs(User::factory()->create());

        $order = Order::factory()->create();

        $data = Order::factory()->make()->toArray();

        $this->json('PUT', 'api/v1/orders/'.$order->id, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'external_id',
                'active_strategy_id',
                'strategy_id',
                'exchange_id',
                'status',
                'symbol',
                'type',
                'side',
                'price',
                'quantity',
                'activation_price',
                'stop_loss',
                'registered_at',
                'executed_at',
                'closed_at', 
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,           
            'external_id' => $order['external_id'],           
            'active_strategy_id' => $order['active_strategy_id'],           
            'strategy_id' => $order['strategy_id'],           
            'exchange_id' => $order['exchange_id'],           
            'status' => $data['status'],           
            'type' => $data['type'],           
            'symbol' => $order['symbol'],           
            'side' => $data['side'],           
            'price' => $data['price'],           
            'quantity' => $data['quantity'],           
        ]);
    }
    
    /** @test */
    public function it_response_in_correct_structure_in_show_endpoint_order()
    {
        $this->actingAs(User::factory()->create());

        $order = Order::factory()->create();

        $this->json('GET', 'api/v1/orders/'.$order->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'external_id',
                'active_strategy_id',
                'strategy_id',
                'exchange_id',
                'status',
                'symbol',
                'type',
                'side',
                'price',
                'quantity',
                'activation_price',
                'stop_loss',
                'registered_at',
                'executed_at',
                'closed_at', 
            ]);
    }
    
    /** @test */
    public function it_response_in_correct_status_after_delete_order()
    {
        $this->actingAs(User::factory()->create());

        $order = Order::factory()->create();

        $this->json('DELETE', 'api/v1/orders/'.$order->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('orders', [
            'id' => $order->id
        ]);
    }

    /** @test */
    public function it_response_in_correct_status_when_order_is_not_found_to_delete()
    {
        $this->actingAs(User::factory()->create());

        $order = Order::factory()->create();

        $this->json('DELETE', 'api/v1/orders/'.$order->id.'1')
            ->assertStatus(404);
    }
}