<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckRole;
use App\Models\EventSportif;
use App\Services\Interfaces\EventSportifServiceInterface;


class OrganizerController extends Controller
{
    public function __construct(private EventSportifServiceInterface $eventSportifService)
    {
        $this->middleware('auth');
        $this->middleware(CheckRole::class . ':organizer');
    }

    public function dashboard()
    {
        // Get Events for the authenticated organizer
        $eventSportitfs = $this->eventSportifService->getEventsByOrganizerId(auth()->user()->id, 3);
        // Meta tags: customize for each page -> SEO
        $data = [
            'title' => $description = "My events sportifs",
            'description' => $description,
            'heading' => $description,
            // Payload: model
            'eventSportifs' => $eventSportitfs,
        ];
        return view('organizer.dashboard',$data);
    }

     // Show create form
    public function create()
    {
        return view('organizer.events.create');
    }

    public function store($request)
    {
        // Create the event
        $eventSportif = $this->eventSportifService->createEvent($request->all());

        // Redirect to the event page
        return redirect()->route('organizer.dashboard')->with('success', 'Event created successfully');
    }

   // Show edit form
    public function edit(EventSportif $event)
    {
        $data=[
            'title' => $description = "Edit event sportif",
            'description' => $description,
            'heading' => $description,
            'event' => $event,
        ];
        return view('organizer.events.create', $data);
    }

    public function update($request, EventSportif $event)
    {
        // Update the event
        $this->eventSportifService->updateEvent($event->id,$request->all());

        // Redirect to the event page
        return redirect()->route('organizer.dashboard')->with('success', 'Event updated successfully');
    }



}
