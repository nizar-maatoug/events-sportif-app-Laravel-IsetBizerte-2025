<?php

namespace Database\Seeders;

use App\Models\EventSportif;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            // Add other seeders...
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@events.com',
            'role_id' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Organizer',
            'email' => 'organizer@events.com',
            'role_id' => 2,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@events.com',
            'role_id' => 3,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);


        $users = User::factory(3)->create();


        $users->each(function($user){
            $user->role_id =random_int(1, 3);
            $user->save();
            $user->eventSportifs()->saveMany(EventSportif::factory(random_int(1,3))
                ->create([
                    'user_id' => $user->id,
                ])->each(function($event){
                    $event->logo()->save(Photo::factory()
                        ->withPath('photos/events/logos', 'storage\default-photos\events\logos\event-'.random_int(1,5).'.png')
                        ->withName($event->name.'-logo')
                        ->withField('logo')

                        ->create());//persister dans la base de données

                    $event->poster()->save(Photo::factory()
                        ->withPath('photos/events/posters', 'storage\default-photos\events\poster\event-poster-'.random_int(1,3).'.png')
                        ->withName($event->name.'-poster')
                        ->withField('poster')
                        ->create());
                })

            );
        });
    }
}
