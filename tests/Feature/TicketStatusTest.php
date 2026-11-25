<?php

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a ticket can transition from waiting to helping and then done', function () {
    $ticket = Ticket::factory()->create(['status' => 'waiting']);

    $this->patch(route('tickets.update', $ticket), ['status' => 'helping'])
        ->assertRedirect(route('tickets.show', $ticket));
    expect($ticket->fresh()->status)->toBe('helping');

    $this->patch(route('tickets.update', $ticket), ['status' => 'done'])
        ->assertRedirect(route('tickets.show', $ticket));
    expect($ticket->fresh()->status)->toBe('done');
});

test('invalid statuses are rejected', function () {
    $ticket = Ticket::factory()->create(['status' => 'waiting']);

    $this->patch(route('tickets.update', $ticket), ['status' => 'sleeping'])
        ->assertSessionHasErrors('status');

    expect($ticket->fresh()->status)->toBe('waiting');
});
