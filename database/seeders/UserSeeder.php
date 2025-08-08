<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Markske',
                'username' => 'biermark',
                'email' => 'markske@brewtopia.be',
                'password' => Hash::make('bier1234'),
                'birthdate' => Carbon::parse('1980-02-14'),
                'image' => 'profile_markske.jpg',
                'about' => 'Ik test bieren voor de wetenschap. Soms té enthousiast.',
            ],
            [
                'name' => 'Xavier',
                'username' => 'tripelxav',
                'email' => 'xavier@brewtopia.be',
                'password' => Hash::make('bier1234'),
                'birthdate' => Carbon::parse('1975-09-09'),
                'image' => 'profile_xavier.jpg',
                'about' => 'Tripel-liefhebber, trainingsbeest en lid van de biermilitie.',
            ],
            [
                'name' => 'Pascalleke',
                'username' => 'pascallekesips',
                'email' => 'pascalleke@brewtopia.be',
                'password' => Hash::make('bier1234'),
                'birthdate' => Carbon::parse('1983-07-05'),
                'image' => 'profile_pascalleke.jpg',
                'about' => 'Ik sip met stijl. Ik keur op uiterlijk én smaak.',
            ],
            [
                'name' => 'Fernand',
                'username' => 'f5reviewz',
                'email' => 'fernand@brewtopia.be',
                'password' => Hash::make('bier1234'),
                'birthdate' => Carbon::parse('1960-11-30'),
                'image' => 'profile_fernand.jpg',
                'about' => 'Marketinggenie en bierverkoper met een neus voor winst.',
            ],
        ];

        foreach ($users as $user) {
            // Kopieer afbeelding van seedermap naar storage
            $sourcePath = database_path('seeders/images/' . $user['image']);
            $targetPath = 'profile_pictures/' . Str::random(10) . '_' . $user['image'];

            // Sla het bestand op in de juiste storage-map
            Storage::disk('public')->put($targetPath, file_get_contents($sourcePath));

            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'birthdate' => $user['birthdate'],
                    'profile_picture' => $targetPath,
                    'about' => $user['about'],
                    'is_admin' => false,
                ]
            );
        }
    }
}