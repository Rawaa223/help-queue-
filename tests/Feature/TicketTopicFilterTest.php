<?php

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the queue only shows tickets matching the selected topic', function () {
    Ticket::factory()->create([
        'name' => 'Git question',
        'topic' => 'Git',
    ]);
    Ticket::factory()->create([
        'name' => 'Laravel question',
        'topic' => 'Laravel',
    ]);

    $this->get(route('tickets.index', ['topic' => 'Git']))
        ->assertOk()
        ->assertSee('Git question')
        ->assertDontSee('Laravel question');
});

test('the queue provides a filter link for each topic', function () {
    $response = $this->get(route('tickets.index'));

    $response->assertOk();
    foreach (Ticket::TOPICS as $topic) {
        $response->assertSee(route('tickets.index', ['topic' => $topic]), false);
    }
});
