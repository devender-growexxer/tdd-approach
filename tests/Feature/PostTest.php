<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function canCreateAPost()
    {
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $response = $this->json('POST', '/api/v1/posts', $data);

        $response->assertStatus(201)
             ->assertJson(compact('data'));
        
        $this->assertDatabaseHas('posts', [
          'title' => $data['title'],
          'description' => $data['description']
        ]);
    }
}
