<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beer;

class BeerSeeder extends Seeder
{
    public function run(): void
    {
        $beers = [
            // Brasserie de la Senne
            ['name' => 'Zinnebir',         'brewery' => 'Brasserie de la Senne', 'style' => 'Belgian Pale Ale', 'abv' => 5.8, 'city' => 'Brussel'],
            ['name' => 'Taras Boulba',     'brewery' => 'Brasserie de la Senne', 'style' => 'Hoppy Blonde',     'abv' => 4.5, 'city' => 'Brussel'],
            ['name' => 'Jambe-de-Bois',    'brewery' => 'Brasserie de la Senne', 'style' => 'Tripel',           'abv' => 8.0, 'city' => 'Brussel'],

            // Brussels Beer Project
            ['name' => 'Delta IPA',        'brewery' => 'Brussels Beer Project', 'style' => 'IPA',              'abv' => 6.5, 'city' => 'Brussel'],
            ['name' => 'Grosse Bertha',    'brewery' => 'Brussels Beer Project', 'style' => 'Weissbier',        'abv' => 7.0, 'city' => 'Brussel'],
            ['name' => 'Jungle Joy',       'brewery' => 'Brussels Beer Project', 'style' => 'Fruit Ale',        'abv' => 5.9, 'city' => 'Brussel'],
            ['name' => 'Babylone',         'brewery' => 'Brussels Beer Project', 'style' => 'Bread IPA',        'abv' => 7.0, 'city' => 'Brussel'],
            ['name' => 'Dark Sister',      'brewery' => 'Brussels Beer Project', 'style' => 'Black IPA',        'abv' => 6.5, 'city' => 'Brussel'],

            // Cantillon
            ['name' => 'Cantillon Gueuze', 'brewery' => 'Brasserie Cantillon',   'style' => 'Gueuze',           'abv' => 5.5, 'city' => 'Anderlecht'],
            ['name' => 'Cantillon Kriek',  'brewery' => 'Brasserie Cantillon',   'style' => 'Kriek',            'abv' => 5.0, 'city' => 'Anderlecht'],
            ['name' => 'Rosé de Gambrinus','brewery' => 'Brasserie Cantillon',   'style' => 'Framboise',        'abv' => 5.0, 'city' => 'Anderlecht'],

            // En Stoemelings
            ['name' => 'Curieuse Neus',    'brewery' => 'En Stoemelings',        'style' => 'Belgian Ale',      'abv' => 6.5, 'city' => 'Brussel'],

            // La Mule
            ['name' => 'La Mule IPA',      'brewery' => 'Brasserie de la Mule',  'style' => 'IPA',              'abv' => 6.0, 'city' => 'Schaarbeek'],
            ['name' => 'La Mule Saison',   'brewery' => 'Brasserie de la Mule',  'style' => 'Saison',           'abv' => 5.5, 'city' => 'Schaarbeek'],

            // La Source
            ['name' => 'La Source Saison', 'brewery' => 'La Source Beer Co.',    'style' => 'Saison',           'abv' => 5.5, 'city' => 'Brussel'],
            ['name' => 'La Source IPA',    'brewery' => 'La Source Beer Co.',    'style' => 'IPA',              'abv' => 6.5, 'city' => 'Brussel'],

            // DOK Brewing Co.
            ['name' => 'A Plein Verre',    'brewery' => 'DOK Brewing Co.',       'style' => 'Sour IPA',         'abv' => 5.5, 'city' => 'Gent'],

        ];

        foreach ($beers as $data) {
            Beer::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
