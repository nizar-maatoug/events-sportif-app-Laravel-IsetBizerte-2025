<?php

namespace App\Services\Interfaces;

use App\Models\Photo;

interface PhotoServiceInterface
{
    public function uploadPhoto($file, $photoableType,$photoableId, $field, $pathToSave): Photo;

    public function updatePhoto($file, $photoId, $pathToSave): Photo;

    public function deletePhoto($photoId): bool;

}
