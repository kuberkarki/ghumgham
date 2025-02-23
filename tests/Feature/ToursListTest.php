<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToursListTest extends TestCase
{
    use RefreshDatabase;

    public function test_tours_list_by_travel_slug_returns_correct_tours(): void
    {
        $travel=Travel::factory()->create();
        $tour=Tour::factory()->create(['travel_id' => $travel->id ]);
        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(1,'data');
        $response->assertJsonPath('data.0.travel_id',$travel->id);

    }
    public function test_tours_list_is_paginated_correctly(): void
    {
        $travel=Travel::factory()->create();
        Tour::factory()->count(16)->create(['travel_id' => $travel->id ]);
        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');
        $response->assertJsonCount(15,'data');
        $response->assertJsonPath('meta.last_page',2);

    }

    public function test_tours_price_is_shown_correctly(): void
    {
        $travel=Travel::factory()->create();
        Tour::factory()->create(['travel_id' => $travel->id,'price'=>123.45 ]);
        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');
        $response->assertJsonCount(1,'data');
        $response->assertJsonFragment(['price'=>'123.45']);

    }
}
