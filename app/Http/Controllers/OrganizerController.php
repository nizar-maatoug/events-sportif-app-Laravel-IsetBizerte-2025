<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckRole;
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

}
