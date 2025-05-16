<?php

namespace App\Http\Controllers;

use App\Services\EventSportifService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private EventSportifService $eventSportifService){}


    public function __invoke(Request $request)
    {
        $events = $this->eventSportifService->getAllEvents();
        $data =[
            'title' => 'Home',
            'description' => 'Welcome to Event Sportif',
            'heading' => config('app.name'),
            'eventSportifs'=> $events,
        ];
        return view('home', $data);

    }
}
