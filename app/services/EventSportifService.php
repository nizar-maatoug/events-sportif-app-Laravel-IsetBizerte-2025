<?php

namespace App\Services;
use App\Models\EventSportif;
use App\Models\Photo;
use App\Services\Interfaces\EventSportifServiceInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;


class EventSportifService implements EventSportifServiceInterface
{


    public function __construct(private PhotoService $photoService)
    {
        // Constructor code if needed
    }

    public function getAllEvents($perPage = 10):Paginator
    {
        return EventSportif::with(['poster','logo'])->paginate($perPage);
    }

    public function getEventById(int $id): ?EventSportif
    {
        return EventSportif::find($id)->with(['poster','logo']);
    }

    public function createEvent(array $data): EventSportif
    {
        // Validate the data
        $data = $this->validateEventData($data);
        DB::beginTransaction();
        // Create the event
        $eventSportif= EventSportif::create($data);
        // Handle the photos
        if (isset($data['poster'])) {
            $poster = $this->photoService->uploadPhoto($data['poster'],get_class($eventSportif),$eventSportif->id, 'poster', 'photos/events/posters');
            $eventSportif->poster()->associate($poster);
        }
        if (isset($data['logo'])) {
            $logo = $this->photoService->uploadPhoto($data['logo'],get_class($eventSportif),$eventSportif->id, 'logo', 'photos/events/logos');
            // Associate the logo with the event
            $eventSportif->logo()->associate($logo);
        }
        // Save the event with the associated photos
        $eventSportif->save();

        // Commit the transaction
        DB::commit();
        return $eventSportif;
    }

    public function updateEvent(int $id, array $data): ?EventSportif
    {
        // Validate the data
        $data = $this->validateEventData($data);

        // Find and update the event
        $event = EventSportif::findOrFail($id);
        if ($event) {
            DB::beginTransaction();
            $event->update($data);
            // Handle the photos
            if (isset($data['poster'])) {
                $poster = $this->photoService->updatePhoto($data['poster'], $event->poster->id, 'photos/events/posters');
                $event->poster()->associate($poster);
            }
            if (isset($data['logo'])) {
                $logo = $this->photoService->updatePhoto($data['logo'], $event->logo->id, 'photos/events/logos');
                // Associate the logo with the event
                $event->logo()->associate($logo);
            }
            DB::commit();
            return $event;
        }
        return null;
    }

    public function deleteEvent(int $id): bool
    {
        $event = EventSportif::find($id);
        if ($event) {
            DB::beginTransaction();
            $event->delete();
            // Delete the associated photos
            if ($event->poster) {
                $this->photoService->deletePhoto($event->poster->id);
            }
            if ($event->logo) {
                $this->photoService->deletePhoto($event->logo->id);
            }
            DB::commit();
            return true;
        }
        return false;
    }

    private function validateEventData(array $data): array
    {
        // Add the user_id to the data array
        // Assuming you have a method to get the authenticated user's ID
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
        //fake user for now (factories)
        return 1;
        //return auth()->id();
    }


}
