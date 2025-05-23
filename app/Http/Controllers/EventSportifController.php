<?php

namespace App\Http\Controllers;

use App\Models\EventSportif;
use App\Services\Interfaces\EventSportifServiceInterface;
use Illuminate\Http\Request;

class EventSportifController extends Controller
{

    public function __construct(public EventSportifServiceInterface $eventSportifService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventSportifs=$this->eventSportifService->getAllEvents();
        $data=[
            //Meta tags: customize for each page -> SEO
            'title' => $description="My events sportifs",
            'description' => $description,
            'heading' => $description,
            //payload: model
            'eventSportifs' => $eventSportifs,
        ];
        return view('events.mes-events',$data);//solliciter blades
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventSportif $eventSportif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventSportif $eventSportif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventSportif $eventSportif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventSportif $eventSportif)
    {
        //
    }
}
