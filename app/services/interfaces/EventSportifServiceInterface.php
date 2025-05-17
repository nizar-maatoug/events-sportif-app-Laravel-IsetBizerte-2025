<?php

namespace App\Services\Interfaces;

use App\Models\EventSportif;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;

interface EventSportifServiceInterface
{
    public function getAllEvents(int $perPage = 10): Paginator;

    public function getEventsByOrganizerId(int $userId, $perPage = 3): Paginator;

    public function getEventById(int $id): ?EventSportif;

    public function createEvent(array $data): EventSportif;

    public function updateEvent(int $id, array $data): ?EventSportif;

    public function deleteEvent(int $id): bool;
}
