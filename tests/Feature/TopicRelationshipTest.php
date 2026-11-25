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
