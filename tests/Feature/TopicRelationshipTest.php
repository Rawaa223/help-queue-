<?php

use App\Models\Ticket;
use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('tickets belong to a topic and topics have many tickets', function () {
    $topic = Topic::create(['name' => 'Git']);
    $ticket = Ticket::factory()->create(['topic_id' => $topic->id]);

    expect($ticket->topic->is($topic))->toBeTrue()
        ->and($topic->tickets->modelKeys())->toBe([$ticket->id]);
});

test('ticket creation rejects a topic id that does not exist', function () {
    $this->post(route('tickets.store'), [
        'name' => 'Topic validation test',
        'topic_id' => 99,
    ])->assertSessionHasErrors([
        'topic_id' => 'The selected topic id is invalid.',
    ]);
});

test('tickets can be created with a valid topic id', function () {
    $topic = Topic::create(['name' => 'Git']);

    $this->post(route('tickets.store'), [
        'name' => 'New Git ticket',
        'topic_id' => $topic->id,
        'description' => 'A test ticket.',
    ])->assertRedirect(route('tickets.index'));

    expect(Ticket::first()->topic->is($topic))->toBeTrue();
});
