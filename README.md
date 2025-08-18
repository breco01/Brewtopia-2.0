BREWTOPIA — Laravel Webapp
==========================

Een complete demo-app rond Belgische bieren, reviews, nieuws en profielen.
Dit project is volledig werkend (incl. seeders, images en adminpaneel) en is
bedoeld als portfolio/schoolopdracht.


INHOUDSOPGAVE
-------------
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
- Authenticatie (Laravel Breeze) + (optioneel) e-mailverificatie
- Publieke bieren:
  - Overzicht met “tegels” en rechts een afbeelding per bier
  - Detailpagina met gemiddelde score, eigen review (aanmaken/bewerken/verwijderen) en alle reviews
- Reviews:
  - Ingelogde gebruikers kunnen per bier 1 review geven (rating 0–5 in stappen van 0,5 + optioneel comment)
  - Gemiddelden en tellers worden getoond; gebruikers zien hun laatste review in het dashboard
- Nieuws (model: News):
  - Publieke index (kaartjes met header-image, datum, excerpt)
  - Show-pagina met header-image en body
  - Admin CRUD-beheer van nieuws
- FAQ (publiek):
  - Overzicht van categorieën met bijhorende vragen/antwoorden
  - Admin CRUD voor categorieën en FAQ-items
- Contact:
  - Publiek contactformulier
  - Voor ingelogde gebruikers: overzicht van eigen berichten en admin-replies;
    badge in de navbar bij ongelezen antwoorden
  - Admin-beheer om berichten te bekijken en te beantwoorden
- Dashboard (ingelogd, niet-admin):
  - Bier van de dag (random bier) met afbeelding
  - Laatste nieuws (3 items)
  - Overzicht-tegel met mini-statistieken (reviews, gemiddelde score, dagen lid, laatste login)
  - Snelle acties (logische links, zonder herhaling)
  - Profiel-onvolledig melding en snelle link naar profiel
- Gebruikers (publieke index):
  - Overzicht met profielfoto en naam; klikken op foto/naam → publieke profielpagina
- Publieke profielpagina:
  - Op basis van username
  - Toont basisinfo, (optioneel) avatar en eventueel activiteit


2) INSTALLATIE & LOKAAL OPSTARTEN
---------------------------------
Benodigdheden:
- PHP 8.2+
- Composer 2+
- Node 18+ & NPM
- MySQL/MariaDB (of SQLite) 
- GD-extensie voor PHP (gebruikt om fallback-afbeeldingen te genereren)

Stappen:
1) Repo clonen
   git clone <JOUW-REPO-URL>
   cd brewtopia

2) Dependencies installeren
   composer install
   npm install

3) .env aanmaken
   cp .env.example .env
   Pas minstens aan:
   APP_NAME="Brewtopia"
   APP_URL=http://localhost
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=brewtopia
   DB_USERNAME=root
   DB_PASSWORD=
   FILESYSTEM_DISK=public   # BELANGRIJK, we gebruiken de 'public' disk

   (Wil je SQLite? Zet DB_CONNECTION=sqlite en verwijder de rest; maak database/database.sqlite aan.)

4) App key genereren
   php artisan key:generate

5) Storage symlink maken (nodig voor alle geuploade/gegenereerde images)
   php artisan storage:link
   → dit maakt 'public/storage' → 'storage/app/public'

6) Database migreren + seeders draaien (laadt alle demo-data + afbeeldingen)
   php artisan migrate:fresh --seed

7) Vite dev server en PHP server starten
   npm run dev        # of: npm run build voor productie
   php artisan serve  # draait standaard op http://127.0.0.1:8000

Open nu http://127.0.0.1:8000 


3) SEEDERDATA, LOGINS & AFBEELDINGEN
------------------------------------
Alle seeders (users, bieren, nieuws, FAQ, …) zijn AI-gegenereerd en bedoeld voor demo.

LOGINS
- Admin
  E-mail:    admin@ehb.be
  Wachtwoord: Password!321
  Is admin:  ja

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
  - Worden door de UserSeeder gekopieerd van database/seeders/images/<profile_*.jpg>
    naar storage/app/public/profile_pictures/<random>_<filename>.jpg
  - In de UI worden ze getoond via: asset('storage/profile_pictures/...')
  - Placeholder: public/images/avatar-placeholder.png

- Nieuwsafbeeldingen (news)
  - Worden door de NewsSeeder gekopieerd van database/seeders/images/news/
    naar storage/app/public/news/
  - In de UI via: asset('storage/news/<bestandsnaam>')
  - Placeholder fallback in views indien nodig

- Bierafbeeldingen (beers)
  - Seeder plaatst per bier een afbeelding in: public/images/beers/
  - Bestandsnaam: gebaseerd op de StudlyCase-naam van het bier, bv. “JambeDeBois.jpg”
    Het script gebruikt ook een eenvoudige JPG-generator (GD) als er geen bron gevonden wordt.
  - In lijstweergaven gebruiken we direct: asset('images/beers/<StudlyName>.jpg') met onerror → placeholder
  - In model (Beer) zit tevens een accessor image_url die eerst zoekt op storage disk (public/beers/*),
    en vervolgens netjes terugvalt naar de public/images/beers/* variant of de algemene placeholder.
  - Algemene placeholder: public/images/beer-placeholder.png

LET OP: Zonder `php artisan storage:link` zijn user/news-afbeeldingen niet zichtbaar.
Bierafbeeldingen staan rechtstreeks onder public/images/beers en vereisen geen symlink.


4) NAVIGATIE & ROUTES (CHEATSHEET)
----------------------------------
Publiek
- /                     → home (statische pagina)
- /bieren               → lijst van bieren (tegels, met afbeelding rechts)
- /bieren/{beer}        → detail van een bier + reviews
- /nieuws               → nieuwsindex (cards met afbeelding)
- /nieuws/{news}        → nieuwsdetail
- /faq                  → veelgestelde vragen (categorieën + items)
- /contact              → contactformulier
- /profiel/{username}   → publiek profiel
- /gebruikers           → overzicht publieke profielen (avatar + naam)

Auth (gebruiker)
- /dashboard            → persoonlijk dashboard (bier van de dag, laatste nieuws, stats, snelle acties)
- /bieren/{beer}/reviews  [POST]   → review opslaan/bijwerken
- /bieren/{beer}/reviews  [DELETE] → eigen review verwijderen
- /contact/overzicht    → overzicht van eigen berichten (incl. admin-replies en unread badge)
- /contact/bericht/{id} → detail van bericht + markeer gelezen

Admin
- /admin                → admin dashboard
- /admin/users          → beheer gebruikers (toggle admin, CRUD)
- /admin/news           → beheer nieuws (CRUD)
- /admin/faq-categories → beheer FAQ-categorieën (CRUD)
- /admin/faqs           → beheer FAQ-items (CRUD)
- /admin/contactformulieren → inkomende berichten + reply


5) DOMEINMODELLEN (OVERZICHT)
-----------------------------
- User
  Velden: name, username, email, password, profile_picture, birthdate, about, last_login_at, is_admin, ...
  Relaties: reviews (hasMany)
  Publiek profiel op /profiel/{username}

- Beer
  Velden: name, brewery, style, abv, city, image (optioneel)
  Relaties: reviews (hasMany), reviewers (belongsToMany via reviews)
  Helpers: averageRating(), reviewsCount(), image_url accessor

- Review
  Velden: user_id, beer_id, rating (0–5, stap 0.5), comment (optioneel)
  Uniek per (user, beer)

- News
  Velden: title, body, image
  Publieke index en detail, admin-CRUD

- FAQ
  FaqCategory heeftMany Faq; publiek overzicht groepeert per categorie

- ContactMessage (naam kan afwijken)
  Inkomende berichten + admin-replies; unread badge via unreadRepliesFor($user)


6) UI-OVERZICHT (WAT JE WAAR ZIET)
----------------------------------
- Navbar (consistent):
  Dashboard (ingelogd), Bieren, Nieuws, FAQ, Contact, Gebruikers, User-menu
- Dashboard (user):
  - BIER VAN DE DAG: random bier + afbeelding + “Beoordeel” CTA
  - LAATSTE NIEUWS: 3 recentste berichten
  - OVERZICHT: reviews, gemiddelde, dagen lid, laatste login (+ link naar bieren of profiel)
  - SNELLE ACTIES: compacte, niet-herhalende CTA’s (bieren, bier vd dag, nieuws, eigen berichten, profiel)
  - Profiel-onvolledig banner (snelle link naar /profile)
- Bieren:
  - Index: tegels met info + afbeelding rechts
  - Show: gegevens + gemiddelde + mijn review-formulier + alle reviews
- Nieuws:
  - Index: header-beeld per item, titel overlay, excerpt, datum
  - Show: grote header-beeld, titel, body, teruglink
- Gebruikers:
  - Grid met avatar, naam en (optioneel) @username; klik → publiek profiel


7) TECHNISCHE KEUZES
--------------------
- Framework: Laravel (Breeze-auth, Blade, Eloquent)
- Frontend: Tailwind CSS, Vite, minimalistische componenten
- Afbeeldingen:
  - Users & News via storage/app/public + asset('storage/...') (vereist storage:link)
  - Beers via public/images/beers (studly bestandsnaam) + fallback naar placeholder
  - GD-extensie gebruikt voor automatische label-afbeeldingen als bron ontbreekt
- Validatie:
  - Reviews: rating 0–5 (step 0.5), comment optioneel
- Middleware:
  - auth op dashboard en reviewroutes
  - admin middleware op /admin/*
  - verified op /dashboard (zie troubleshooting als e-mailverificatie niet geconfigureerd is)


8) TROUBLESHOOTING
------------------
A) Afbeeldingen van users/news niet zichtbaar
   - Voer uit: php artisan storage:link
   - Controleer dat bestanden bestaan in storage/app/public/{profile_pictures|news}
   - APP_URL in .env correct? (bijv. http://127.0.0.1:8000)

B) Bierafbeeldingen niet zichtbaar
   - Controleer public/images/beers/
   - Bestandsnamen zijn StudlyCase van de biernaam (bv. JambeDeBois.jpg)
   - Als bron ontbreekt, genereert de seeder een eenvoudige JPG (vereist php-gd)

C) Dashboard vereist e-mailverificatie
   - Deze route gebruikt middleware 'verified'.
   - Opties:
     1) Configureer mail (MAIL_MAILER=log of smtp) en verifieer via link
     2) Tijdelijk middleware 'verified' verwijderen in routes/web.php
     3) Markeer gebruikers als verified in DB:
        php artisan tinker
        >>> \App\Models\User::query()->update(['email_verified_at' => now()]);
        exit

D) Symlink werkt niet (Windows)
   - Start terminal als Administrator, voer opnieuw uit: php artisan storage:link
   - Of gebruik WSL/Ubuntu

E) 404 op /gebruikers of /bieren/…
   - Controleer routes in routes/web.php en cache:
     php artisan route:clear

F) CSS/JS niet geladen
   - Draai Vite:
     npm run dev
   - Of build voor productie:
     npm run build
     php artisan view:clear && php artisan cache:clear


9) LICENTIE
-----------
MIT License © 2025 Brent Cornet