<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    // database/seeders/RolesTableSeeder.php
    public function run()
    {
        Role::create(['name' => 'admin', 'description' => 'Administrator']);
        Role::create(['name' => 'organizer', 'description' => 'Event Organizer']);
        Role::create(['name' => 'user', 'description' => 'Regular User']);
    }
}
