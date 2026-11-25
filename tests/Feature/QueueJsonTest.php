<?php

use App\Models\Ticket;
use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the queue endpoint returns only waiting tickets with their topic', function () {
    $topic = Topic::create(['name' => 'Git']);
    Ticket::factory()->create([
        'name' => 'Waiting ticket',
        'topic_id' => $topic->id,
        'status' => 'waiting',
    ]);
    Ticket::factory()->create([
        'topic_id' => $topic->id,
        'status' => 'helping',
    ]);

    $this->getJson(route('queue.json'))
        ->assertOk()
        ->assertJsonCount(1)
        ->assertJsonPath('0.name', 'Waiting ticket')
        ->assertJsonPath('0.status', 'waiting')
        ->assertJsonPath('0.topic.name', 'Git');
});

test('the home page redirects to the ticket queue', function () {
    $this->get('/')
        ->assertRedirect(route('tickets.index'));
});
