<div align="center">

# BREWTOPIA  
**Laravel Webapp – Bieren • Reviews • Nieuws • Profielen**

[![Made with Laravel](https://img.shields.io/badge/Made%20with-Laravel-red?logo=laravel&logoColor=white)](#)
![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-777bb4?logo=php&logoColor=white)
![Node 18+](https://img.shields.io/badge/Node-18%2B-339933?logo=nodedotjs&logoColor=white)
![License: MIT](https://img.shields.io/badge/License-MIT-000)

**Demo-app rond Belgische bieren** met reviews, nieuws, FAQ, contact, publieke profielen en een adminpaneel.  
Volledig werkend met seeders + afbeeldingen.

</div>

---

## Snel naar
- [Functionaliteit](#-functionaliteit)
- [Installatie & opstarten](#️-installatie--opstarten)
- [Logins & seeders](#-logins--seeders)
- [Afbeeldingen](#-afbeeldingen)
- [Routes (cheatsheet)](#-routes-cheatsheet)
- [Modellen](#-modellen)
- [UI-overzicht](#-ui-overzicht)
- [Techniek](#-techniek)
- [Troubleshooting](#-troubleshooting)
- [Licentie](#-licentie)

---

## Functionaliteit

- **Authenticatie** (Laravel Breeze) + *optioneel* e-mailverificatie voor het dashboard  
- **Bieren (publiek):**  
  Overzicht met tegels + **afbeelding rechts**, detail met **gemiddelde score**, **mijn review** (aanmaken/bewerken/verwijderen) en **alle reviews**  
- **Reviews:**  
  1 review per bier per user (0–5 in stappen van 0,5 + optioneel comment)  
- **Nieuws (model: `News`):**  
  Index met header-afbeelding & datum, show met grote header, **Admin CRUD**  
- **FAQ (publiek) + Admin CRUD** voor categorieën & vragen  
- **Contact:**  
  Publiek formulier; ingelogde gebruikers hebben een overzicht van eigen berichten + **admin-replies** (badge in navbar bij ongelezen)  
- **Dashboard (user):**  
  **Bier van de dag** (random) met afbeelding → *Beoordeel*-CTA, **Laatste nieuws (3)**, **Overzicht** mini-stats, **Snelle acties**, **Profiel-onvolledig** banner  
- **Gebruikers (publiek):**  
  Grid met **avatar + naam**; klik naar publieke profielpagina  
- **Publiek profiel:**  
  Op `/profiel/{username}` met basisinfo, avatar en (optioneel) activiteit

---

## Installatie & opstarten

**Benodigdheden**
- PHP **8.2+**, Composer **2+**
- Node **18+**, NPM
- MySQL/MariaDB (of SQLite)
- PHP-extensie **GD** (voor fallback bier-afbeeldingen)

**Stappen**

# 1) Repo clonen
git clone https://github.com/<jouw-account>/Brewtopia-2.0.git
cd Brewtopia-2.0

# 2) Dependencies
composer install
npm install

# 3) .env aanmaken en invullen (zie hieronder)
cp .env.example .env

Minimaal in `.env` (pas aan waar nodig):

APP_NAME="Brewtopia"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=brewtopia
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public

# 4) App key
php artisan key:generate

# 5) Storage symlink (nodig voor user/news images)
php artisan storage:link

# 6) Migrate + seed (laadt demo-data en afbeeldingen)
php artisan migrate:fresh --seed

# 7) Start servers
npm run dev        # of: npm run build
php artisan serve  # http://127.0.0.1:8000

> Open **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## Logins & seeders

Alle seeders (users, bieren, nieuws, FAQ, …) zijn **AI-gegenereerd** en bedoeld voor demo/doeleinden.

**Admin**

| Rol   | E-mail         | Wachtwoord     |
| ----- | -------------- | -------------- |
| Admin | `admin@ehb.be` | `Password!321` |

**Testgebruikers**

| Naam       | Username         | E-mail                    | Wachtwoord |
| ---------- | ---------------- | ------------------------- | ---------- |
| Markske    | `biermark`       | `markske@brewtopia.be`    | `bier1234` |
| Xavier     | `tripelxav`      | `xavier@brewtopia.be`     | `bier1234` |
| Pascalleke | `pascallekesips` | `pascalleke@brewtopia.be` | `bier1234` |
| Fernand    | `f5reviewz`      | `fernand@brewtopia.be`    | `bier1234` |

---

## Afbeeldingen

**Users (profielfoto’s)**

* Bron: `database/seeders/images/profile_*.jpg`
* Doel (na seeden): `storage/app/public/profile_pictures/<random>_<filename>.jpg`
* Weergave in views: `asset('storage/profile_pictures/...')`
* Placeholder: `public/images/avatar-placeholder.png`

**Nieuws (`News`)**

* Bron: `database/seeders/images/news/*.jpg`
* Doel: `storage/app/public/news/*.jpg`
* Weergave: `asset('storage/news/<bestandsnaam>')` (met `onerror` → placeholder)

**Bieren (`Beer`)**

* Doel: `public/images/beers/`
* Bestandsnaam: **StudlyCase** van biernaam, bv. `JambeDeBois.jpg`
* Als bron ontbreekt, genereert seeder **automatisch een eenvoudige JPG** (GD)
* Lijstweergave: `asset('images/beers/<StudlyName>.jpg')` (`onerror` → `beer-placeholder.png`)
* `Beer`-model heeft accessor `image_url` met nette fallback
* Placeholder: `public/images/beer-placeholder.png`

> **Belangrijk:** zonder `php artisan storage:link` zijn **user** en **news** afbeeldingen niet zichtbaar. Bieren staan rechtstreeks in `public/`.

---

## Routes (cheatsheet)

<details>
<summary><b>Publiek</b></summary>

| Route                 | Beschrijving                        |
| --------------------- | ----------------------------------- |
| `/`                   | Home                                |
| `/bieren`             | Lijst bieren (tegels + afbeelding)  |
| `/bieren/{beer}`      | Detail + reviews                    |
| `/nieuws`             | Nieuwsindex                         |
| `/nieuws/{news}`      | Nieuwsdetail                        |
| `/faq`                | FAQ-overzicht (categorieën + items) |
| `/contact`            | Contactformulier                    |
| `/profiel/{username}` | Publiek profiel                     |
| `/gebruikers`         | Overzicht publieke profielen        |

</details>

<details>
<summary><b>Auth (gebruiker)</b></summary>

| Route                    | Methode  | Beschrijving                                   |
| ------------------------ | -------- | ---------------------------------------------- |
| `/dashboard`             | GET      | Dashboard (bier vd dag, nieuws, stats, acties) |
| `/bieren/{beer}/reviews` | POST     | Review opslaan/bijwerken                       |
| `/bieren/{beer}/reviews` | DELETE   | Eigen review verwijderen                       |
| `/contact/overzicht`     | GET      | Overzicht eigen berichten + admin-replies      |
| `/contact/bericht/{id}`  | GET/POST | Detail + markeer gelezen                       |

</details>

<details>
<summary><b>Admin</b></summary>

| Route                       | Beschrijving                          |
| --------------------------- | ------------------------------------- |
| `/admin`                    | Admin-dashboard                       |
| `/admin/users`              | Gebruikersbeheer (toggle admin, CRUD) |
| `/admin/news`               | Nieuwsbeheer (CRUD)                   |
| `/admin/faq-categories`     | FAQ-categorieën (CRUD)                |
| `/admin/faqs`               | FAQ-items (CRUD)                      |
| `/admin/contactformulieren` | Inkomende berichten + reply           |

</details>

> Middleware: `auth` voor user-routes, `admin` voor admin-routes, `verified` op `/dashboard`.

---

## Modellen

**User**
Velden: `name, username, email, password, profile_picture, birthdate, about, last_login_at, is_admin, ...`
Relatie: `hasMany(Review)`

**Beer**
Velden: `name, brewery, style, abv, city, image?`
Relaties: `hasMany(Review)`, `belongsToMany(User) via reviews`
Helpers: `averageRating()`, `reviewsCount()`, accessor `image_url`

**Review**
Velden: `user_id, beer_id, rating (0–5, step 0.5), comment?`
Constraint: **uniek per (user, beer)**

**News**
Velden: `title, body, image` (publieke index & detail + Admin CRUD)

**FAQ**
`FaqCategory hasMany Faq` (publieke weergave groepeert per categorie)

**ContactMessage**
Inkomende berichten + admin-replies; unread badge via `unreadRepliesFor($user)`

---

## UI-overzicht

* **Navbar**: Dashboard (ingelogd), **Bieren**, **Nieuws**, **FAQ**, **Contact**, **Gebruikers**, user-menu
* **Dashboard**:

  * *Bier van de dag* (random) + afbeelding + CTA
  * *Laatste nieuws* (3)
  * *Overzicht* mini-stats (reviews, gemiddelde, dagen lid, laatste login)
  * *Snelle acties* (compact, zonder herhaling)
  * *Profiel-onvolledig* banner
* **Bieren**: index (tegels met image), show (details + mijn review + alle reviews)
* **Nieuws**: index (grote header-image), show (header-image + body)
* **Gebruikers**: grid met avatar + naam → publiek profiel

---

## Techniek

* **Framework**: Laravel (Breeze, Blade, Eloquent)
* **Frontend**: Tailwind CSS + Vite
* **Afbeeldingen**:

  * Users/News → `storage/app/public` + `asset('storage/...')` (*vereist* `storage:link`)
  * Beers → `public/images/beers` (StudlyCase bestandsnaam) + model-fallback
  * Fallbacks: `avatar-placeholder.png`, `beer-placeholder.png` (+ optioneel news-placeholder)
  * GD-extensie voor auto-generatie eenvoudig bierlabel als bron ontbreekt
* **Validatie**: reviews 0–5 (step 0.5), comment optioneel
* **Middleware**: `auth`, `admin`, en `verified` (dashboard)

---

## Troubleshooting

**A) Users/News afbeeldingen niet zichtbaar**

* `php artisan storage:link`
* Bestaat het bestand in `storage/app/public/{profile_pictures|news}`?
* Klopt `APP_URL` in `.env` (bijv. `http://127.0.0.1:8000`)?

**B) Bierafbeeldingen niet zichtbaar**

* Check `public/images/beers/`
* Bestandsnamen zijn **StudlyCase** van de biernaam (bv. `JambeDeBois.jpg`)
* Geen bron? Seeder maakt automatisch een JPG (vereist **php-gd**)

**C) “Verified” vereist voor dashboard**

1. `MAIL_MAILER=log` of `smtp` configureren en mail volgen
2. Tijdelijk middleware `verified` verwijderen in `routes/web.php`
3. Of in DB alles verifiëren:

   ```php
   php artisan tinker
   >>> \App\Models\User::query()->update(['email_verified_at' => now()]);
   ```

**D) Symlink werkt niet (Windows)**

* Terminal als Administrator → `php artisan storage:link`
* Of WSL/Ubuntu gebruiken

**E) Routes/Cache issues**

```
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

**F) CSS/JS laadt niet**

* `npm run dev` laten draaien
* Of build:

  ```
  npm run build
  php artisan view:clear && php artisan cache:clear
  ```

---

## Licentie

MIT License © 2025 Brent Cornet
