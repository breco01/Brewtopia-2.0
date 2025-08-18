BREWTOPIA — Laravel Webapp (Bieren • Reviews • Nieuws • Profielen)
==================================================================

Een complete demo-app rond Belgische bieren, reviews, nieuws en publieke profielen.
Dit project is volledig werkend (incl. seeders, afbeeldingen en adminpaneel) en is bedoeld
als portfolio/schoolopdracht.

INHOUD
------
1) Belangrijkste functionaliteit
2) Installatie & lokaal opstarten
3) Seederdata, logins & afbeeldingen
4) Navigatie & routes (cheatsheet)
5) Domeinmodellen (overzicht)
6) UI-overzicht (wat je waar ziet)
7) Technische keuzes
8) Troubleshooting
9) Licentie


1) BELANGRIJKSTE FUNCTIONALITEIT
--------------------------------
- Authenticatie (Laravel Breeze) + (optioneel) e-mailverificatie voor dashboard
- Publieke bieren:
  - Overzicht met tegels en rechts per bier een afbeelding
  - Detailpagina met gemiddelde score, eigen review (aanmaken/bewerken/verwijderen) en alle reviews
- Reviews:
  - Ingelogde gebruikers kunnen per bier 1 review geven (rating 0–5 in stappen van 0,5 + optioneel comment)
  - Gemiddelden en aantallen worden getoond; in het dashboard zie je je laatste review
- Nieuws (model: News):
  - Publieke index met header-afbeelding, datum en korte intro
  - Show-pagina met header-afbeelding en volledige tekst
  - Admin CRUD-beheer van nieuwsartikels
- FAQ (publiek) + Admin:
  - Overzicht van categorieën met bijhorende vragen/antwoorden
  - Admin CRUD voor categorieën en FAQ-items
- Contact:
  - Publiek contactformulier
  - Voor ingelogde gebruikers: overzicht van eigen berichten en admin-replies;
    badge in de navbar bij ongelezen antwoorden
  - Admin-beheer om berichten te bekijken en te beantwoorden
- Dashboard (ingelogd, niet-admin):
  - “Bier van de dag” (random bier) met afbeelding + snelle link om te beoordelen
  - “Laatste nieuws” (3 items)
  - “Overzicht” met mini-statistieken (reviews, gemiddelde score, dagen lid, laatste login)
  - “Snelle acties” (logische CTA’s, zonder herhaling)
  - Banner wanneer je profiel onvolledig is (link naar profiel)
- Gebruikers (publieke index):
  - Overzicht met profielfoto en naam; klik naar publieke profielpagina
- Publieke profielpagina:
  - Op basis van username
  - Toont basisinfo, avatar en (optioneel) activiteit


2) INSTALLATIE & LOKAAL OPSTARTEN
---------------------------------
Benodigdheden
- PHP 8.2+
- Composer 2+
- Node 18+ & NPM
- MySQL/MariaDB (of SQLite)
- PHP-extensie GD (gebruikt voor fallback-afbeeldingen bij bieren)

Stappen
1) Repo clonen
   git clone https://github.com/<jouw-account>/Brewtopia-2.0.git
   cd Brewtopia-2.0

2) Dependencies installeren
   composer install
   npm install

3) .env aanmaken
   cp .env.example .env
   Pas minstens aan:
   APP_NAME="Brewtopia"
   APP_URL=http://127.0.0.1:8000

   # MySQL
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=brewtopia
   DB_USERNAME=root
   DB_PASSWORD=

   # Bestanden (heel belangrijk voor afbeeldingen)
   FILESYSTEM_DISK=public

   (Wil je SQLite? Zet DB_CONNECTION=sqlite en maak database/database.sqlite aan.)

4) App key genereren
   php artisan key:generate

5) Storage symlink maken (nodig voor user/news-afbeeldingen)
   php artisan storage:link
   → maakt public/storage → storage/app/public

6) Database migreren + seeders draaien (laadt alle demo-data + afbeeldingen)
   php artisan migrate:fresh --seed

7) Vite dev server en PHP server starten
   npm run dev         # tijdens ontwikkeling
   # of: npm run build # voor productie build
   php artisan serve   # http://127.0.0.1:8000

Open nu http://127.0.0.1:8000


3) SEEDERDATA, LOGINS & AFBEELDINGEN
------------------------------------
Alle seeders (users, bieren, nieuws, FAQ, …) zijn AI-gegenereerd en bedoeld voor demo.

LOGINS
- Admin
  E-mail:     admin@ehb.be
  Wachtwoord: Password!321
  Is admin:   ja

- Testgebruikers
  1) naam: Markske
     username: biermark
     e-mail:   markske@brewtopia.be
     wachtwoord: bier1234

  2) naam: Xavier
     username: tripelxav
     e-mail:   xavier@brewtopia.be
     wachtwoord: bier1234

  3) naam: Pascalleke
     username: pascallekesips
     e-mail:   pascalleke@brewtopia.be
     wachtwoord: bier1234

  4) naam: Fernand
     username: f5reviewz
     e-mail:   fernand@brewtopia.be
     wachtwoord: bier1234

AFBEELDINGEN — structuur & gedrag
- Profielfoto’s (users)
  - Door UserSeeder gekopieerd van: database/seeders/images/profile_*.jpg
    naar: storage/app/public/profile_pictures/<random>_<filename>.jpg
  - In views: asset('storage/profile_pictures/...') met placeholder als fallback
  - Placeholder: public/images/avatar-placeholder.png

- Nieuwsafbeeldingen (news)
  - Door NewsSeeder gekopieerd van: database/seeders/images/news/*.jpg
    naar: storage/app/public/news/*.jpg
  - In views: asset('storage/news/<bestandsnaam>') met onerror → placeholder
  - Placeholder: public/images/news-placeholder.jpg (of generieke fallback in de view)

- Bierafbeeldingen (beers)
  - BeerSeeder zet per bier een afbeelding in: public/images/beers/
  - Bestandsnaam: StudlyCase van de biernaam, vb. “JambeDeBois.jpg”
    (indien geen bron: eenvoudige JPG wordt automatisch gegenereerd via GD)
  - In lijstweergaven: asset('images/beers/<StudlyName>.jpg') + onerror → beer-placeholder
  - In model (Beer) is er een accessor `image_url` die netjes fallbacked.
  - Placeholder: public/images/beer-placeholder.png

LET OP: Zonder `php artisan storage:link` zijn user/news-afbeeldingen NIET zichtbaar.
Bierafbeeldingen staan rechtstreeks onder public/ en vereisen geen symlink.


4) NAVIGATIE & ROUTES (CHEATSHEET)
----------------------------------
Publiek
- /                      → home (statisch)
- /bieren                → lijst bieren (tegels + afbeelding rechts)
- /bieren/{beer}         → detail bier + reviews
- /nieuws                → nieuwsindex (cards met image)
- /nieuws/{news}         → nieuwsdetail
- /faq                   → veelgestelde vragen (categorieën + items)
- /contact               → contactformulier
- /profiel/{username}    → publiek profiel
- /gebruikers            → overzicht publieke profielen

Auth (gebruiker)
- /dashboard             → persoonlijk dashboard (bier vd dag, laatste nieuws, stats, snelle acties)
- /bieren/{beer}/reviews   [POST]   → review opslaan/bijwerken (1 per bier)
- /bieren/{beer}/reviews   [DELETE] → eigen review verwijderen
- /contact/overzicht     → overzicht eigen berichten (incl. admin-replies en “unread” badge)
- /contact/bericht/{id}  → detail bericht + markeer gelezen

Admin
- /admin                 → admin-dashboard
- /admin/users           → beheer gebruikers (toggle admin, CRUD)
- /admin/news            → beheer nieuws (CRUD)
- /admin/faq-categories  → beheer FAQ-categorieën (CRUD)
- /admin/faqs            → beheer FAQ-items (CRUD)
- /admin/contactformulieren → inkomende berichten + reply

(Authenticatie & middleware: `auth` voor user-routes, `admin` voor admin-routes, `verified` op /dashboard.)


5) DOMEINMODELLEN (OVERZICHT)
-----------------------------
- User
  Velden: name, username, email, password, profile_picture, birthdate, about, last_login_at, is_admin, ...
  Relatie: reviews (hasMany)
  Publiek profiel op /profiel/{username}

- Beer
  Velden: name, brewery, style, abv, city, image (optioneel)
  Relaties: reviews (hasMany), reviewers (belongsToMany via reviews)
  Helpers: averageRating(), reviewsCount(), accessor image_url

- Review
  Velden: user_id, beer_id, rating (0–5, stap 0.5), comment (optioneel)
  Constraint: unieke combinatie (user, beer) → 1 review per gebruiker per bier

- News
  Velden: title, body, image
  Publieke index en detail, admin-CRUD

- FAQ
  FaqCategory hasMany Faq; publiek overzicht groepeert per categorie

- ContactMessage (naam kan afwijken)
  Inkomende berichten + admin-replies; unread badge via unreadRepliesFor($user)


6) UI-OVERZICHT (WAT JE WAAR ZIET)
----------------------------------
- Navbar (consistent):
  Dashboard (ingelogd), Bieren, Nieuws, FAQ, Contact, Gebruikers, User-menu (profiel/uitloggen)
- Dashboard (user):
  - Bier van de dag: random bier + afbeelding + “Beoordeel” CTA
  - Laatste nieuws: 3 recentste items
  - Overzicht: reviews, gemiddelde, dagen lid, laatste login (+ link naar bieren / profiel)
  - Snelle acties: compacte CTA’s (bieren, bier vd dag, nieuws, eigen berichten, profiel)
  - Profiel-onvolledig banner met link naar /profile
- Bieren:
  - Index: tegels met info + afbeelding rechts
  - Show: gegevens + gemiddelde + mijn review-formulier + alle reviews
- Nieuws:
  - Index: grote header-afbeelding per item, titel overlay, datum
  - Show: grote header-afbeelding, titel, body, “terug naar overzicht”
- Gebruikers:
  - Grid met avatar, naam en (optioneel) @username; klik → publiek profiel


7) TECHNISCHE KEUZES
--------------------
- Framework: Laravel (Breeze-auth, Blade, Eloquent)
- Frontend: Tailwind CSS + Vite
- Afbeeldingen:
  - Users & News → storage/app/public + asset('storage/...') (vereist storage:link)
  - Beers → public/images/beers (StudlyCase bestandsnaam) + model-accessor fallback
  - Fallbacks: avatar-placeholder / beer-placeholder / (optioneel) news-placeholder
  - GD-extensie voor automatisch genereren van een simpel bierlabel als bron ontbreekt
- Validatie:
  - Reviews: rating 0–5 (step 0.5), comment optioneel
- Middleware:
  - `auth` op user-routes
  - `admin` op /admin/*
  - `verified` op /dashboard (zie Troubleshooting om dit uit te zetten of te simuleren)


8) TROUBLESHOOTING
------------------
A) Afbeeldingen users/news niet zichtbaar
   - Run: php artisan storage:link
   - Bestaat het bestand in storage/app/public/{profile_pictures|news}?
   - Klopt APP_URL in .env? (bijv. http://127.0.0.1:8000)

B) Bierafbeeldingen niet zichtbaar
   - Controleer public/images/beers/
   - Bestandsnamen zijn StudlyCase van de biernaam (bv. JambeDeBois.jpg)
   - Geen bron? Seeder genereert automatisch een eenvoudige JPG (vereist php-gd)

C) “Verified” vereist voor dashboard
   - Opties:
     1) MAIL_MAILER=log of smtp configureren en verifiëren via e-mail
     2) Tijdelijk middleware ‘verified’ verwijderen in routes/web.php
     3) In DB alle users verifiëren:
        php artisan tinker
        >>> \App\Models\User::query()->update(['email_verified_at' => now()]);

D) Symlink werkt niet (Windows)
   - Terminal als Administrator → php artisan storage:link
   - Of WSL/Ubuntu gebruiken

E) Routes niet gevonden / cache issues
   - php artisan route:clear
   - php artisan view:clear
   - php artisan cache:clear

F) CSS/JS niet geladen
   - npm run dev laten draaien
   - Of builden:
     npm run build
     php artisan view:clear && php artisan cache:clear


9) LICENTIE
-----------
MIT License © 2025 Brent Cornet