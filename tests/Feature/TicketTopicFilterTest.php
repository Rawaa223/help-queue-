<?php

use App\Models\Ticket;
use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the queue only shows tickets matching the selected topic', function () {
    $git = Topic::create(['name' => 'Git']);
    $laravel = Topic::create(['name' => 'Laravel']);

    Ticket::factory()->create([
        'name' => 'Git question',
        'topic_id' => $git->id,
    ]);
    Ticket::factory()->create([
        'name' => 'Laravel question',
        'topic_id' => $laravel->id,
    ]);

    $this->get(route('tickets.index', ['topic' => 'Git']))
        ->assertOk()
        ->assertSee('Git question')
        ->assertDontSee('Laravel question');
});

test('the queue provides a filter link for each topic', function () {
    foreach (['Git', 'Laravel', 'Blade', 'Database', 'Setup'] as $name) {
        Topic::create(['name' => $name]);
    }
    $response = $this->get(route('tickets.index'));

    $response->assertOk();
    foreach (Topic::all() as $topic) {
        $response->assertSee(route('tickets.index', ['topic' => $topic->name]), false);
    }
});
