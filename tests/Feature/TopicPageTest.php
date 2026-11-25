<?php

use App\Models\Ticket;
use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a topic page lists its tickets and count', function () {
    $topic = Topic::create(['name' => 'Git']);
    Ticket::factory()->create([
        'name' => 'Git ticket one',
        'topic_id' => $topic->id,
    ]);
    Ticket::factory()->create([
        'name' => 'Git ticket two',
        'topic_id' => $topic->id,
    ]);

    $this->get(route('topics.show', $topic))
        ->assertOk()
        ->assertSeeText('Topic: Git')
        ->assertSeeText('2 tickets')
        ->assertSeeText('Git ticket one')
        ->assertSeeText('Git ticket two');
});
