<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventSportifResource;
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
        return EventSportifResource::collection($this->eventSportifService->getAllEvents());
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
