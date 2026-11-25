<?php

use App\Models\Ticket;
use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('waiting and helping scopes return the right tickets', function () {
    $topic = Topic::create(['name' => 'Git']);
    $waiting = Ticket::factory()->create(['status' => 'waiting', 'topic_id' => $topic->id]);
    $helping = Ticket::factory()->create(['status' => 'helping', 'topic_id' => $topic->id]);
    Ticket::factory()->create(['status' => 'done', 'topic_id' => $topic->id]);

    expect(Ticket::waiting()->pluck('id')->all())->toBe([$waiting->id])
        ->and(Ticket::helping()->pluck('id')->all())->toBe([$helping->id]);
});

test('the queue groups tickets by status and counts completed tickets', function () {
    $topic = Topic::create(['name' => 'Git']);
    Ticket::factory()->create([
        'name' => 'Helping ticket',
        'status' => 'helping',
        'topic_id' => $topic->id,
    ]);
    Ticket::factory()->create([
        'name' => 'Waiting ticket',
        'status' => 'waiting',
        'topic_id' => $topic->id,
    ]);
    Ticket::factory()->create(['status' => 'done', 'topic_id' => $topic->id]);

    $this->get(route('tickets.index'))
        ->assertOk()
        ->assertSee('Being helped')
        ->assertSee('Helping ticket')
        ->assertSee('Waiting (1)')
        ->assertSee('1 solved so far.');
});
