<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function index(Request $request): View
    {
        $topic = $request->query('topic');
        if ($topic !== null && ! is_string($topic)) {
            abort(400, 'The topic query parameter must be a string.');
        }

        $filterByTopic = function ($query) use ($topic) {
            if ($topic !== null && $topic !== '') {
                $query->whereHas('topic', fn ($topicQuery) => $topicQuery->where('name', $topic));
            }

            return $query;
        };

        return view('tickets.index', [
            'helping' => $filterByTopic(Ticket::helping())->get(),
            'waiting' => $filterByTopic(Ticket::waiting())->get(),
            'doneCount' => $filterByTopic(Ticket::where('status', 'done'))->count(),
            'topics' => Topic::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'topic' => ['required', 'exists:topics,name'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);
        $topic = Topic::where('name', $validated['topic'])->firstOrFail();
        unset($validated['topic']);
        $validated['topic_id'] = $topic->id;
        Ticket::create($validated);

        return redirect()->route('tickets.index')->with('message', 'You are in the
queue!');
    }

    public function show(Ticket $ticket)
    {
        $ahead = Ticket::waiting()->where('id', '<', $ticket->id)->count();

        return view('tickets.show', [
            'ticket' => $ticket,
            'ahead' => $ahead,
        ]);
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(Ticket::STATUSES)],
        ]);

        $ticket->status = $validated['status'];
        $ticket->save();

        return redirect()->route('tickets.show', $ticket)->with('message', 'Status updated.');
    }

    public function create()
    {
        return view('tickets.create', ['topics' => Topic::orderBy('name')->pluck('name')]);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('message', 'Ticket removed.');
    }
}
