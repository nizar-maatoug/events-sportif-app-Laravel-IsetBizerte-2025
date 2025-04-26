<?php

namespace App\Services;
use App\Models\EventSportif;
use App\Services\Interfaces\EventSportifServiceInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;


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
        // Validate the data
        $data = $this->validateEventData($data);
        // Create the event
        return EventSportif::create($data);
    }

    public function updateEvent(int $id, array $data): ?EventSportif
    {
        // Validate the data
        $data = $this->validateEventData($data);
        // Find and update the event
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

    private function validateEventData(array $data): array
    {
        $data['user_id'] = $this->getAuthUSerId();
        // Here you can implement your validation logic
        // For example, you can use Laravel's Validator facade
        $validator= Validator::make($data, [
            'name' => ['required','string','max:100',Rule::unique('event_sportifs')->ignore($data['id'] ?? null)],
            'sport' => ['required', Rule::in(['TaeKwondo', 'Judo', 'Karate', 'Boxe', 'KungFu', 'Aikido'])],
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => ['required', Rule::in(['open', 'closed', 'cancelled'])],
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        // If validation passes, you can return the validated data


        return $data; // Return the validated data
    }

    private function getAuthUSerId(): int
    {
        //fake user for now
        return 1;
        //return auth()->id();
    }


}
