<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // Eerst categorieën aanmaken
        $categories = [
            'Algemeen', 'Bier beoordelen', 'Account', 'Nieuws', 'Community'
        ];

        $categoryIds = [];

        foreach ($categories as $name) {
            $id = DB::table('faq_categories')->insertGetId([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $categoryIds[$name] = $id;
        }

        // Daarna FAQ's aanmaken
        $faqs = [
            // Algemeen
            ['Wat is Brewtopia?', 'Brewtopia is een platform voor bierliefhebbers waar je bieren kunt ontdekken, beoordelen en bespreken.', 'Algemeen'],
            ['Is Brewtopia gratis?', 'Ja, het gebruik van Brewtopia is volledig gratis.', 'Algemeen'],
            ['Kan ik zelf bieren toevoegen?', 'Ja, geregistreerde gebruikers kunnen nieuwe bieren voorstellen voor review.', 'Algemeen'],
            ['Hoe meld ik een fout op de site?', 'Gebruik het contactformulier om bugs of suggesties door te geven.', 'Algemeen'],

            // Bier beoordelen
            ['Hoe geef ik een bier een rating?', 'Klik op het bier en selecteer het aantal sterren om je beoordeling toe te voegen.', 'Bier beoordelen'],
            ['Wat betekenen de sterren?', '1 ster = slecht, 5 sterren = uitstekend. Baseer je beoordeling op smaak, geur en uiterlijk.', 'Bier beoordelen'],
            ['Kan ik mijn beoordeling aanpassen?', 'Ja, ga naar je profiel en bewerk je review.', 'Bier beoordelen'],
            ['Worden mijn reviews publiek getoond?', 'Ja, je reviews zijn zichtbaar op de bierpagina en je profiel.', 'Bier beoordelen'],

            // Account
            ['Hoe maak ik een account aan?', 'Klik op "Registreer" bovenaan en vul je gegevens in.', 'Account'],
            ['Ik ben mijn wachtwoord vergeten, wat nu?', 'Gebruik de "Wachtwoord vergeten" link op de loginpagina.', 'Account'],
            ['Hoe verwijder ik mijn account?', 'Stuur een verzoek via het contactformulier.', 'Account'],
            ['Is mijn profiel publiek?', 'Ja, tenzij je het privé zet via je instellingen.', 'Account'],

            // Nieuws
            ['Waar vind ik het laatste biernieuws?', 'Op de nieuwspagina bovenaan het dashboard.', 'Nieuws'],
            ['Kan ik reageren op artikels?', 'Momenteel is reageren niet mogelijk, maar deze functie wordt overwogen.', 'Nieuws'],
            ['Hoe vaak verschijnen er nieuwe artikels?', 'Meestal wekelijks, afhankelijk van ons redactieteam.', 'Nieuws'],
            ['Wie schrijft de artikels?', 'Onze redactie en gastschrijvers uit de biercommunity.', 'Nieuws'],

            // Community
            ['Hoe kan ik andere bierliefhebbers volgen?', 'Via hun profiel kun je op “Volgen” klikken.', 'Community'],
            ['Wat is de communitypagina?', 'Een plek waar je andere gebruikers, ratings en trends ontdekt.', 'Community'],
            ['Kan ik berichten sturen naar anderen?', 'Privéberichten zijn nog niet beschikbaar.', 'Community'],
            ['Hoe meld ik ongepast gedrag?', 'Via de meldknop op gebruikersprofielen of reviews.', 'Community'],
        ];

        foreach ($faqs as [$question, $answer, $category]) {
            DB::table('faqs')->insert([
                'question' => $question,
                'answer' => $answer,
                'faq_category_id' => $categoryIds[$category],
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);
        }
    }
}
