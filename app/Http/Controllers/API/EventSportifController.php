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
        $eventSportif = $this->eventSportifService->createEvent($request->all());
        return response()->json([
            'message' => 'Event created successfully',
            'event' => new EventSportifResource($eventSportif)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EventSportif $eventSportif)
    {
        $eventSportif = $this->eventSportifService->getEventById($eventSportif->id);
        if (!$eventSportif) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }
        return response()->json([
            'event' => new EventSportifResource($eventSportif)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventSportif $eventSportif)
    {
        $eventSportif = $this->eventSportifService->updateEvent($eventSportif->id, $request->all());
        return response()->json([
            'message' => 'Event updated successfully',
            'event' => new EventSportifResource($eventSportif)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventSportif $eventSportif)
    {
        $this->eventSportifService->deleteEvent($eventSportif->id);
        return response()->json([
            'message' => 'Event deleted successfully'
        ], 200);
    }
}
