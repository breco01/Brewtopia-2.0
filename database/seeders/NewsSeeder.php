<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        foreach ($articles as $article) {
            DB::table('news')->insert([
                'title' => $article['title'],
                'body' => $article['body'],
                'image' => $article['image'],
                'created_at' => $article['created_at'],
                'updated_at' => now(),
            ]);
        }
    }
}
