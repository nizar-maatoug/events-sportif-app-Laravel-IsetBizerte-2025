<?php
namespace App\Services;
use App\Models\Photo;
use App\Services\Interfaces\PhotoServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class PhotoService implements PhotoServiceInterface
{
    public function uploadPhoto($file, $photoableType,$photoableId, $field, $pathToSave): Photo
    {
        $photo = new Photo();
        $photo->name = Str::uuid().'.'.$file->getClientOriginalExtension();
        $photo->photoable_type = $photoableType;
        $photo->photoable_id = $photoableId;
        $photo->field = $field;

        if ($file instanceof UploadedFile) {
            $photo->path = Storage::disk('public')->putFile($pathToSave, $file);
            $photo->url = config('app.url').'/storage/'.Str::after($photo->path, 'public/');
            $photo->size = $file->getSize();
            $photo->width = 800;//$file->getWidth();
            $photo->height = 500;//$file->getHeight();
            $photo->thumbnail_path = $photo->path;
            $photo->thumbnail_url = config('app.url').'/storage/'.Str::after($photo->path, 'public/');
        } else {
            throw new \InvalidArgumentException('The file must be an instance of UploadedFile.');
        }
        $photo->save();
        return $photo;
    }

    public function updatePhoto($file, $photoId, $pathToSave): Photo
    {
        $photo = Photo::findOrFail($photoId);

        if ($file instanceof UploadedFile) {
            // Delete the old file
            Storage::delete($photo->path);

            // Store the new file
            $photo->path = Storage::disk('public')->putFile($pathToSave, $file);
            $photo->url = config('app.url').'/storage/'.Str::after($photo->path, 'public/');
            $photo->size = $file->getSize();
            $photo->width = $file->getWidth();
            $photo->height = $file->getHeight();
            $photo->thumbnail_path = $photo->path;
            $photo->thumbnail_url = $photo->url;
            $photo->name = $file->getClientOriginalName();

        } else {
            throw new \InvalidArgumentException('The file must be an instance of UploadedFile.');
        }

        $photo->save();

        return $photo;
    }
    public function deletePhoto($photoId): bool
    {
        $photo = Photo::findOrFail($photoId);

        // Delete the file from storage
        Storage::delete($photo->path);

        // Delete the photo record from the database
        return $photo->delete();
    }


}
