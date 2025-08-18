<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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

        $this->ensureBeerImages();
    }

    protected function ensureBeerImages(): void
    {
        $publicBase  = public_path('images');
        $publicBeers = $publicBase . DIRECTORY_SEPARATOR . 'beers';
        $seedBeers   = database_path('seeders/images/beers');

        if (!File::exists($publicBeers)) {
            File::makeDirectory($publicBeers, 0755, true);
        }

        // Placeholder neerzetten (klein PNG)
        $placeholder = $publicBase . DIRECTORY_SEPARATOR . 'beer-placeholder.png';
        if (!File::exists($placeholder)) {
            File::put($placeholder, base64_decode(self::PLACEHOLDER_PNG_BASE64));
        }

        Beer::query()->each(function (Beer $beer) use ($seedBeers, $publicBeers) {
            $studly = Str::of($beer->name)->ascii()->studly();   // bv. JambeDeBois
            $dest   = $publicBeers . DIRECTORY_SEPARATOR . $studly . '.jpg';
            $src    = $seedBeers   . DIRECTORY_SEPARATOR . $studly . '.jpg';

            if (File::exists($src)) {
                // Kopieer bron → public
                File::copy($src, $dest);
            } else {
                // Geen bron: genereer een eenvoudig label
                $this->makeBeerJpg($dest, $beer->name, $beer->brewery);
            }
        });
    }

    protected function makeBeerJpg(string $path, string $name, ?string $brewery = null): void
    {
        if (function_exists('imagecreatetruecolor') && function_exists('imagejpeg')) {
            $w = $h = 300;
            $im = imagecreatetruecolor($w, $h);

            $bg  = imagecolorallocate($im, 240, 231, 219);
            $fg1 = imagecolorallocate($im,  90,  58,  34);
            $fg2 = imagecolorallocate($im, 120,  80,  50);
            $bd  = imagecolorallocate($im, 200, 170, 120);

            imagefilledrectangle($im, 0, 0, $w, $h, $bg);
            imagerectangle($im, 0, 0, $w - 1, $h - 1, $bd);

            $title = mb_strimwidth($name, 0, 22, '…', 'UTF-8');
            imagestring($im, 5, 16, 110, $title, $fg1);

            if ($brewery) {
                $sub = mb_strimwidth($brewery, 0, 26, '…', 'UTF-8');
                imagestring($im, 3, 16, 140, $sub, $fg2);
            }

            imagejpeg($im, $path, 85);
            imagedestroy($im);
            return;
        }

        File::put($path, base64_decode(self::FALLBACK_JPG_BASE64));
    }

    private const PLACEHOLDER_PNG_BASE64 =
        'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=';

    private const FALLBACK_JPG_BASE64 =
        '/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAQEA8PEA8QDw8QDw8PDw8PDw8QFREWFhURFRUYHSggGBolGxUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OFQ8QFS0dHR0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAAEAAQMBIgACEQEDEQH/xAAXAAEBAQEAAAAAAAAAAAAAAAAAAQID/8QAFxABAQEBAAAAAAAAAAAAAAAAAQARIf/EABYBAQEBAAAAAAAAAAAAAAAAAAABAv/EABYRAQEBAAAAAAAAAAAAAAAAAAABEf/aAAwDAQACEQMRAD8A9gA//9k=';
}
