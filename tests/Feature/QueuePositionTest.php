<?php

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('waiting ticket pages show the number of earlier waiting tickets', function () {
    Ticket::factory()->create(['status' => 'waiting']);
    Ticket::factory()->create(['status' => 'helping']);
    $ticket = Ticket::factory()->create(['status' => 'waiting']);

    $this->get(route('tickets.show', $ticket))
        ->assertOk()
        ->assertSeeText('1 person ahead of you.');
});

test('non-waiting ticket pages do not show a queue position', function () {
    $ticket = Ticket::factory()->create(['status' => 'helping']);

    $this->get(route('tickets.show', $ticket))
        ->assertOk()
        ->assertDontSee('ahead of you.');
});
