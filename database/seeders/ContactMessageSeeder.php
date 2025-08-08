<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Markske',
                'email' => 'markske@brewtopia.be',
                'subject' => 'Bier vergeten',
                'message' => "Ik had gisteren een geniaal bier ontdekt maar ik ben de naam vergeten. Kunnen jullie mijn log raadplegen of zo?",
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'name' => 'Xavier',
                'email' => 'xavier@brewtopia.be',
                'subject' => 'Suggestie voor bier van de dag',
                'message' => "Kunnen jullie 'Xavier Tripel Turbo' eens voorstellen als bier van de dag? Ik heb er zelf een sixpack van gemaakt!",
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'name' => 'Pascalleke',
                'email' => 'pascalleke@brewtopia.be',
                'subject' => 'Mijn profiel is te publiek',
                'message' => "Hallo, mijn foto's zijn blijkbaar publiek zichtbaar. Kunnen jullie dat beperken? Merci!",
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'name' => 'Fernand',
                'email' => 'fernand@brewtopia.be',
                'subject' => 'Onterecht geblokkeerd?',
                'message' => "Waarom zijn mijn reviews verwijderd? Ik ben gewoon enthousiast. (En oké, misschien heb ik iets te vaak 'ongelooflijk fantastisch' geschreven)",
                'created_at' => Carbon::now()->subDay(),
            ],
        ];

        foreach ($messages as $message) {
            ContactMessage::create($message + [
                'status' => 'new',
                'is_read' => false,
                'updated_at' => now(),
            ]);
        }
    }
}
