<?php

namespace App\Services;
use App\Models\EventSportif;
use App\Services\Interfaces\EventSportifServiceInterface;
use Illuminate\Contracts\Pagination\Paginator;

class EventSportifService implements EventSportifServiceInterface
{
    public function getAllEvents($perPage = 10):Paginator
    {
        return EventSportif::paginate($perPage);
    }

    public function getEventById(int $id): ?EventSportif
    {
        return EventSportif::find($id);
    }

    public function createEvent(array $data): EventSportif
    {
        return EventSportif::create($data);
    }

    public function updateEvent(int $id, array $data): ?EventSportif
    {
        $event = EventSportif::findOrFail($id);
        if ($event) {
            $event->update($data);
            return $event;
        }
        return null;
    }

    public function deleteEvent(int $id): bool
    {
        $event = EventSportif::find($id);
        if ($event) {
            return $event->delete();
        }
        return false;
    }
}
