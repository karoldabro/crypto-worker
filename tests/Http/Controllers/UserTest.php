<?php

namespace Kdabrow\CryptoWorker\Tests\Http\Controllers;

use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorker\Models\User;

class UserTest extends TestCase
{
    /** @test */
    public function it_response_in_correct_structure_after_create_user()
    {
        $this->actingAs(User::factory()->create());
       
        $user = User::factory()->make()->makeVisible(['password'])->toArray();

        $this->json('POST', 'api/v1/users', $user)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'email', 
            ]);

        $this->assertDatabaseHas('users', [
            'name' => $user['name'],
            'email' => $user['email'],
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_user_list()
    {
        $this->actingAs(User::factory()->create());

        User::factory()->make()->toArray();

        $this->json('GET', 'api/v1/users')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'email',

                    ]
                ],
                'links',
                'meta'
            ]);
    }

    /** @test */
    public function it_response_in_correct_structure_after_update_user()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $data = User::factory()->make()->toArray();

        $this->json('PUT', 'api/v1/users/' . $user->id, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    /** @test */
    public function it_response_in_correct_structure_in_show_endpoint_user()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $this->json('GET', 'api/v1/users/' . $user->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
            ]);
    }

    /** @test */
    public function it_response_in_correct_status_after_delete_user()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $this->json('DELETE', 'api/v1/users/' . $user->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }

    /** @test */
    public function it_response_in_correct_status_when_user_is_not_found_to_delete()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $this->json('DELETE', 'api/v1/users/' . $user->id.'1')
            ->assertStatus(404);
    }
}
