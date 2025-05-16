<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{

    public $photoPath = '';
    public $defautPath = '';
    public $field = '';

    public $photoName = '';
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::disk('public')->makeDirectory($this->photoPath);
        return [
            'name' => $this->photoName,
            'path' => $path = Storage::disk('public')->putFile($this->photoPath, public_path($this->defautPath) ),
            'url' => $url = config('app.url').'/storage/'.Str::after($path, 'public/'),
            'thumbnail_path' => $path,
            'thumbnail_url' => $url,
            'field' => $this->field,
            'size' => 1024 * 1024 * random_int(1, 3),
            'width' => 1024,
            'height' => 768,
        ];
    }

    public function withPath(string $path, string $defaultPath): self{
        $this->photoPath = $path;
        $this->defautPath = $defaultPath;

        return $this;

    }

    public function withName($name){
        $this->photoName = $name;
        return $this;

    }

    public function withField($field){
       $this->field = $field;
        return $this;
    }
}
