<?php

use App\Models\Ticket;
use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('waiting ticket pages show the number of earlier waiting tickets', function () {
    $topic = Topic::create(['name' => 'Git']);
    Ticket::factory()->create(['status' => 'waiting', 'topic_id' => $topic->id]);
    Ticket::factory()->create(['status' => 'helping', 'topic_id' => $topic->id]);
    $ticket = Ticket::factory()->create(['status' => 'waiting', 'topic_id' => $topic->id]);

    $this->get(route('tickets.show', $ticket))
        ->assertOk()
        ->assertSeeText('1 person ahead of you.');
});

test('non-waiting ticket pages do not show a queue position', function () {
    $topic = Topic::create(['name' => 'Git']);
    $ticket = Ticket::factory()->create([
        'status' => 'helping',
        'topic_id' => $topic->id,
    ]);

    $this->get(route('tickets.show', $ticket))
        ->assertOk()
        ->assertDontSee('ahead of you.');
});
