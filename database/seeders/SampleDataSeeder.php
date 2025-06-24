<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Event;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // Admin / Organizer
        User::create([
            'name' => 'Organizer Admin',
            'email' => 'organizer@example.com',
            'password' => Hash::make('password'),
            'is_vip' => true
        ]);

        // VIP Customer
        User::create([
            'name' => 'VIP User',
            'email' => 'vip@example.com',
            'password' => Hash::make('password'),
            'is_vip' => true
        ]);

        // Regular Customer
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'is_vip' => false
        ]);

        // Events
        Event::create([
            'name' => 'Music Festival 2025',
            'date' => now()->addDays(10),
            'venue' => 'Stadium A',
            'total_tickets' => 100,
            'ticket_price' => 50,
            'created_at' => now()->subHours(12), // Created 12 hours ago (still VIP window)
        ]);

        Event::create([
            'name' => 'Tech Conference',
            'date' => now()->addDays(20),
            'venue' => 'Conference Hall',
            'total_tickets' => 200,
            'ticket_price' => 120,
            'created_at' => now()->subDays(3), // Created 3 days ago (VIP window passed)
        ]);

        Event::create([
            'name' => 'Art Exhibition',
            'date' => now()->addDays(5),
            'venue' => 'Art Center',
            'total_tickets' => 50,
            'ticket_price' => 30,
            'created_at' => now()->subHours(6), // Created 6 hours ago (VIP window still active)
        ]);

        echo "Sample data seeded successfully.\n";
    }
}
