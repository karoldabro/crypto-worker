<?php

namespace Kdabrow\CryptoWorker\Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorker\Models\User;
use Kdabrow\CryptoWorker\Models\Exchange;

class ExchangeTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_response_in_correct_structure_after_create_exchange()
    {
        $this->actingAs(User::factory()->create());

        $exchange = Exchange::factory()->make()->makeVisible(['credentials'])->toArray();

        $this->json('POST', 'api/v1/exchanges', $exchange)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
            ]);

        $this->assertDatabaseHas('exchanges', [
            'name' => $exchange['name'],
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_exchange_list()
    {
        $this->actingAs(User::factory()->create());

        Exchange::factory()->count(2)->create();

        $this->json('GET', 'api/v1/exchanges')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                    ]
                ],
                'links',
                'meta'
            ]);
    }

    /** @test */
    public function it_response_in_correct_structure_after_update_exchange()
    {
        $this->actingAs(User::factory()->create());

        $exchange = Exchange::factory()->create();

        $data = Exchange::factory()->make()->toArray();

        $this->json('PUT', 'api/v1/exchanges/' . $exchange->id, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
            ]);

        $this->assertDatabaseHas('exchanges', [
            'id' => $exchange->id,
            'name' => $data['name'],
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_show_endpoint_exchange()
    {
        $this->actingAs(User::factory()->create());

        $exchange = Exchange::factory()->create();

        $this->json('GET', 'api/v1/exchanges/' . $exchange->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
            ]);
    }

    /** @test */
    public function it_response_in_correct_status_after_delete_exchange()
    {
        $this->actingAs(User::factory()->create());

        $exchange = Exchange::factory()->create();

        $this->json('DELETE', 'api/v1/exchanges/' . $exchange->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('exchanges', [
            'id' => $exchange->id
        ]);
    }

    /** @test */
    public function it_response_in_correct_status_when_exchange_is_not_found_to_delete()
    {
        $this->actingAs(User::factory()->create());

        $exchange = Exchange::factory()->create();

        $this->json('DELETE', 'api/v1/exchanges/' . $exchange->id . '1')
            ->assertStatus(404);
    }
}
