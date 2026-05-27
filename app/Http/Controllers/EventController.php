<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $eventsQuery = Event::orderBy('date')->orderBy('created_at');

        if ($search) {
            $eventsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        return view('welcome', [
            'events' => $eventsQuery->get(),
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'private' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
            'items' => 'nullable|array',
            'items.*' => 'string|max:255',
            'date' => 'required|date',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $destination = public_path('img/events');

            if (! is_dir($destination)) {
                mkdir($destination, 0775, true);
            }

            $image->move($destination, $imageName);
        }

        Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'city' => $validated['city'],
            'private' => $validated['private'],
            'image' => $imageName,
            'items' => $validated['items'] ?? [],
            'date' => $validated['date'],
        ]);

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }
}
