<?php

namespace Database\Seeders;

use App\Models\EventSportif;
use App\Models\Photo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(2)->create();

        $users->each(function($user){
            $user->eventSportifs()->saveMany(EventSportif::factory(random_int(1,3))
                ->create([
                    'user_id' => $user->id,
                ])->each(function($event){
                    $event->logo()->save(Photo::factory()
                        ->withPath('photos/events/logos', 'storage\default-photos\events\logos\event-'.random_int(1,5).'.png')
                        ->withName($event->name.'-logo')

                        ->create());//persister dans la base de données

                    $event->poster()->save(Photo::factory()
                        ->withPath('photos/events/posters', 'storage\default-photos\events\poster\event-poster-'.random_int(1,3).'.png')
                        ->withName($event->name.'-poster')
                        ->create());
                })

            );
        });
    }
}
