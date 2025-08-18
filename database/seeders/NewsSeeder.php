<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Boma lanceert “Bierke Boma” – met geheime kruidenmix',
                'body' => "Balthasar Boma heeft via het bierplatform 'Brewtopia' zijn eigen bier gelanceerd: Bierke Boma. Volgens hem is het een 'krachtig blondje met karakter, net als ik'. Het bier werd massaal gereviewd, al zijn de meningen verdeeld. Xavier gaf het vijf sterren: 'Perfect na een zware training, vooral als je niet getraind hebt'. Carmen daarentegen vond het te straf: 'Na twee slokken dacht ik dat ik terug in mijn missverkiezing zat'. Het bier bevat naar verluidt een geheime mix van mosterdzaad en ‘een snuifje Boma-charme’. Fernand beweert dat hij het recept stiekem heeft geüpload onder een valse account. De admins van Brewtopia zijn in ieder geval blij: ‘Het is het best beoordeelde en tegelijk meest gerapporteerde bier op het platform’.",
                'image' => 'kampioen1.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 20)),
            ],
            [
                'title' => 'Markske test 37 bieren op één avond – en vergeet zijn paswoord',
                'body' => "Tijdens een interne test van het beoordelingssysteem van de Brewtopia-app, besloot Markske 37 bieren op één avond te proeven. 'Voor de wetenschap', aldus zijn officiële reden. Na bier 18 begon hij sterretjes toe te wijzen aan zijn pantoffels, en tegen bier 30 probeerde hij zijn schoen te resetten. De volgende ochtend bleek hij zijn wachtwoord én gebruikersnaam vergeten te zijn. Gelukkig had Carmen screenshots genomen: ‘Hij gaf een IPA een 10 op 5 omdat ze hem “keek met pit”.’ De ontwikkelaars overwegen nu een limiet van 10 beoordelingen per dag in te voeren. Oscar is sceptisch: ‘Vroeger hadden we een bierkaart en dat werkte prima’.",
                'image' => 'kampioen2.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 20)),
            ],
            [
                'title' => 'Fernand verkoopt fake reviews op Brewtopia',
                'body' => "Het Brewtopia-team ontdekte dat er plots opvallend veel vijfsterrenreviews verschenen bij een verdacht bier genaamd 'Fernand’s Fantastische Faro'. Na onderzoek bleek dat Fernand zelf een reviewbureautje had opgestart: voor €2 schreef hij een lofzang, voor €5 kwam er zelfs een rijm bij. 'Het is geen bedrog, het is marketing', beweert hij. Pascalleke voelde zich misleid: 'Ik dacht dat het fruitig was, maar het smaakt naar verdunde afwas.' De moderators van de site hebben inmiddels een 'Fernand-filter' geïnstalleerd die valse beoordelingen opspoort, zoals: 'Dit bier is als een zonsondergang op de tong'. Fernand laat zich niet kennen: 'Volgende week verkoop ik echte reviews, handgeschreven!'",
                'image' => 'kampioen3.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 20)),
            ],
            [
                'title' => 'Xavier verwart bier-van-de-dag met fitnessschema',
                'body' => "Brewtopia’s 'bier van de dag'-functie werd deze week per ongeluk gelinkt aan Xavier zijn trainingsapp. Gevolg: hij kreeg pushmeldingen als 'Start je dag met een tripel!' en 'Vergeet je Bock niet na het squatten!'. Xavier volgde trouw de instructies, wat leidde tot een “intensieve cardio op de cafévloer”. Markske vond het dan weer een geniale combinatie: 'Sportdrank met karakter'. De bug is intussen opgelost, al zou Xavier ‘per ongeluk’ de meldingen weer hebben aangezet. De community overweegt nu een nieuwe functie: “bierpairing met sporten”. Carmen stelt voor: 'Pintjes bij pilates'.",
                'image' => 'kampioen4.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 20)),
            ],
            [
                'title' => 'DDT hackt Brewtopia en roept zijn eigen bier uit tot #1',
                'body' => "Een mysterieuze bug zorgde ervoor dat het obscure bier 'DDT Dubbel Diesel' plots op nummer één stond op Brewtopia. Xavier: 'Het smaakt naar versleten autoband met een vleugje koffie'. Bij controle bleek dat DDT een oude laptop had gebruikt om in te breken op het platform. 'Ik wilde bewijzen dat mijn brouwsel minstens even straf is als Boma’s!', zei hij tijdens zijn verhoor. De admins hebben het lek gedicht, maar DDT houdt vol: 'Het publiek wil eerlijkheid, en ik geef hen diesel met schuim'. Ondertussen heeft zijn bier 213 rapporteringen en één review: 'Heeft me mijn wenkbrauwen gekost'.",
                'image' => 'kampioen5.jpg',
                'created_at' => Carbon::now()->subDays(rand(1, 20)),
            ],
        ];

        // Insert
        foreach ($articles as $article) {
            DB::table('news')->insert([
                'title'       => $article['title'],
                'body'        => $article['body'],
                'image'       => $article['image'], // bv. kampioen1.jpg
                'created_at'  => $article['created_at'],
                'updated_at'  => now(),
            ]);
        }

        // Zorg dat de images ook effectief in public/images/news terechtkomen
        $this->ensureNewsImages();
    }

    protected function ensureNewsImages(): void
    {
        $publicBase = public_path('images');
        $publicNews = $publicBase . DIRECTORY_SEPARATOR . 'news';
        $seedNews   = database_path('seeders/images/news');

        if (!File::exists($publicNews)) {
            File::makeDirectory($publicNews, 0755, true);
        }

        // Placeholder plaatsen
        $placeholder = $publicBase . DIRECTORY_SEPARATOR . 'news-placeholder.png';
        if (!File::exists($placeholder)) {
            File::put($placeholder, base64_decode(self::PLACEHOLDER_PNG_BASE64));
        }

        // Voor elk news-item: kopieer seed → public, of genereer fallback
        News::query()->each(function (News $news) use ($seedNews, $publicNews) {
            // Bepaal mogelijke bronbestanden (expliciet en afgeleid)
            $candidates = [];
            if (!empty($news->image)) {
                $candidates[] = $news->image;
            }
            $studly = (string) Str::of($news->title)->ascii()->studly();
            foreach ([$studly, Str::slug($news->title, ''), Str::slug($news->title, '-')] as $base) {
                foreach (['.jpg', '.jpeg', '.png', '.webp'] as $ext) {
                    $candidates[] = $base . $ext;
                }
            }
            $candidates = array_values(array_unique($candidates));

            // Zoek eerste bestaande bron in seed-map
            $srcFile = null;
            foreach ($candidates as $file) {
                $maybe = $seedNews . DIRECTORY_SEPARATOR . $file;
                if (File::exists($maybe)) {
                    $srcFile = $maybe;
                    $dest    = $publicNews . DIRECTORY_SEPARATOR . $file;
                    File::copy($srcFile, $dest);
                    // Zorg dat de DB-kolom 'image' netjes de filename bevat
                    if ($news->image !== $file) {
                        DB::table('news')->where('id', $news->id)->update(['image' => $file]);
                    }
                    return; // klaar voor dit item
                }
            }

            // Geen seed-bestand? Genereer een eenvoudige JPEG met titel
            $dest = $publicNews . DIRECTORY_SEPARATOR . ($news->image ?: ($studly . '.jpg'));
            $this->makeNewsJpg($dest, $news->title);
            // Zet 'image' indien leeg
            if (empty($news->image)) {
                DB::table('news')->where('id', $news->id)->update(['image' => basename($dest)]);
            }
        });
    }

    protected function makeNewsJpg(string $path, string $title): void
    {
        if (function_exists('imagecreatetruecolor') && function_exists('imagejpeg')) {
            $w = 600; $h = 300;
            $im = imagecreatetruecolor($w, $h);

            $bg  = imagecolorallocate($im, 245, 238, 226);
            $fg1 = imagecolorallocate($im,  70,  45,  28);
            $bd  = imagecolorallocate($im, 210, 178, 120);

            imagefilledrectangle($im, 0, 0, $w, $h, $bg);
            imagerectangle($im, 0, 0, $w - 1, $h - 1, $bd);

            $t = mb_strimwidth($title, 0, 48, '…', 'UTF-8');
            // eenvoudige centered-ish text
            imagestring($im, 5, 24, 130, $t, $fg1);

            imagejpeg($im, $path, 85);
            imagedestroy($im);
            return;
        }

        // Fallback 1x1
        File::put($path, base64_decode(self::FALLBACK_JPG_BASE64));
    }

    private const PLACEHOLDER_PNG_BASE64 =
        'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=';

    private const FALLBACK_JPG_BASE64 =
        '/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAQEA8PEA8QDw8QDw8PDw8PDw8QFREWFhURFRUYHSggGBolGxUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OFQ8QFS0dHR0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAAEAAQMBIgACEQEDEQH/xAAXAAEBAQEAAAAAAAAAAAAAAAAAAQID/8QAFxABAQEBAAAAAAAAAAAAAAAAAQARIf/EABYBAQEBAAAAAAAAAAAAAAAAAAABAv/EABYRAQEBAAAAAAAAAAAAAAAAAAABEf/aAAwDAQACEQMRAD8A9gA//9k=';
}
