<?php

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('waiting and helping scopes return the right tickets', function () {
    $waiting = Ticket::factory()->create(['status' => 'waiting']);
    $helping = Ticket::factory()->create(['status' => 'helping']);
    Ticket::factory()->create(['status' => 'done']);

    expect(Ticket::waiting()->pluck('id')->all())->toBe([$waiting->id])
        ->and(Ticket::helping()->pluck('id')->all())->toBe([$helping->id]);
});

test('the queue groups tickets by status and counts completed tickets', function () {
    Ticket::factory()->create([
        'name' => 'Helping ticket',
        'status' => 'helping',
    ]);
    Ticket::factory()->create([
        'name' => 'Waiting ticket',
        'status' => 'waiting',
    ]);
    Ticket::factory()->create(['status' => 'done']);

    $this->get(route('tickets.index'))
        ->assertOk()
        ->assertSee('Being helped')
        ->assertSee('Helping ticket')
        ->assertSee('Waiting (1)')
        ->assertSee('1 solved so far.');
});
