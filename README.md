# Spotted — Backend

**Spotted** è una directory di piccole attività locali (negozi, artigiani, locali, servizi) pensata per dare visibilità a chi ha del potenziale ma è ancora poco conosciuto. Ogni attività viene raccontata con la sua storia, la sua categoria e i tratti distintivi che la rendono speciale.

Questo repository contiene il **backend**: un backoffice in Laravel per gestire i contenuti e un'API REST pubblica in sola lettura che alimenta il sito React ([`spotted-frontend`](https://github.com/francesco-cassese/spotted-frontend)).

Il progetto è l'esame finale del corso Full Stack.

## Architettura

```
┌───────────────────────┐   richieste HTTP (JSON)   ┌──────────────────────────┐
│   spotted-frontend    │ ────────────────────────► │   spotted (questo repo)  │
│   React + Vite        │                           │   Laravel 11 + MySQL     │
│   localhost:5173      │                           │   127.0.0.1:8000         │
└───────────────────────┘                           │   ├─ Backoffice (Blade)  │
                                                    │   └─ API REST (JSON)     │
                                                    └──────────────────────────┘
```

- **Backoffice**: pagine Blade protette da login, per creare, modificare ed eliminare attività, categorie e tratti distintivi.
- **API pubblica**: espone gli stessi dati in sola lettura, senza autenticazione.

## Funzionalità

**Backoffice (area riservata)**
- Autenticazione con Laravel Breeze (login, registrazione, reset password, profilo)
- Dashboard con il conteggio di attività, categorie e tratti distintivi
- CRUD completo su **attività** (`Business`), con upload dell'immagine di copertina
- CRUD completo su **categorie** (`Category`)
- CRUD completo su **tratti distintivi** (`DistinctiveTrait`)
- Ogni attività ha una categoria e almeno un tratto distintivo
- Una categoria con attività collegate non può essere eliminata (messaggio di errore al posto dell'eliminazione)
- Quando si sostituisce o si elimina un'attività, anche il file dell'immagine viene rimosso dal disco

**API REST (pubblica, sola lettura)**
- Elenco delle attività con la loro categoria
- Dettaglio di un'attività tramite slug, con categoria e tratti distintivi
- Elenco delle categorie

## Stack tecnologico

- **PHP 8.2+** e **Laravel 11**
- **Laravel Breeze** (stack Blade) per l'autenticazione
- **Blade** per le viste del backoffice
- **Bootstrap 5** con **Sass** per lo stile, compilati con **Vite**
- **MySQL** come database
- **Eloquent ORM** per accedere ai dati

## Screenshot

| Dashboard | Elenco attività |
|---|---|
| ![Dashboard](docs/screenshots/dashboard.png) | ![Elenco attività](docs/screenshots/businesses-index.png) |

| Nuova attività | Categorie |
|---|---|
| ![Nuova attività](docs/screenshots/business-create.png) | ![Categorie](docs/screenshots/categories-index.png) |

| Tratti distintivi |
|---|
| ![Tratti distintivi](docs/screenshots/distinctive-traits-index.png) |

## Modello dati

| Tabella | Campi principali |
|---|---|
| `categories` | `name`, `slug` (univoco) |
| `distinctive_traits` | `name` (univoco) |
| `businesses` | `name`, `slug` (univoco), `story`, `address`, `contact`, `cover_image`, `category_id` |
| `business_distinctive_trait` | tabella pivot: `business_id`, `distinctive_trait_id` |

Relazioni Eloquent:

- `Business` **belongsTo** `Category` (1-N: ogni attività appartiene a una categoria)
- `Category` **hasMany** `Business`
- `Business` **belongsToMany** `DistinctiveTrait` (N-N tramite la tabella pivot)
- `DistinctiveTrait` **belongsToMany** `Business`

Regole di integrità sul database:

- `businesses.category_id` usa `ON DELETE RESTRICT`: il database non permette di eliminare una categoria che ha ancora attività.
- La tabella pivot usa `ON DELETE CASCADE`: eliminando un'attività o un tratto vengono rimossi anche i collegamenti.

## Requisiti

- PHP 8.2 o superiore
- [Composer](https://getcomposer.org/)
- Node.js 20 o superiore e [pnpm](https://pnpm.io/)
- MySQL

## Installazione

1. **Dipendenze PHP**

   ```bash
   composer install
   ```

2. **File di ambiente e chiave dell'applicazione**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configurazione del `.env`.** Crea un database MySQL vuoto (per esempio `spotted`) e imposta questi valori. Il file di esempio usa SQLite, quindi vanno modificati:

   ```dotenv
   APP_URL=http://127.0.0.1:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=spotted
   DB_USERNAME=root
   DB_PASSWORD=

   FILESYSTEM_DISK=public
   ```

   - `FILESYSTEM_DISK=public` fa salvare le immagini caricate in `storage/app/public`, la cartella resa raggiungibile dal browser.
   - `APP_URL` viene usato per costruire gli indirizzi delle immagini restituiti dall'API (`cover_image_url`): deve coincidere con l'indirizzo del server.

4. **Tabelle e dati di esempio**

   ```bash
   php artisan migrate --seed
   ```

   Il seeder crea l'utente di prova, 4 categorie, 5 tratti distintivi e 6 attività con le loro immagini.

5. **Collegamento della cartella delle immagini**

   ```bash
   php artisan storage:link
   ```

6. **Dipendenze JavaScript e asset del backoffice**

   ```bash
   pnpm install
   pnpm dev
   ```

   Lascia `pnpm dev` in esecuzione in un terminale (oppure usa `pnpm build` una volta sola).

7. **Avvio del server**, in un secondo terminale:

   ```bash
   php artisan serve
   ```

Il backoffice è su `http://127.0.0.1:8000/login`. Credenziali di prova create dal seeder:

| Email | Password |
|---|---|
| `test@example.com` | `password` |

Per vedere il sito pubblico avvia anche il [frontend React](https://github.com/francesco-cassese/spotted-frontend).

## API REST

Base URL: `http://127.0.0.1:8000/api`. Le rotte sono pubbliche e in sola lettura.

| Metodo | Endpoint | Descrizione |
|---|---|---|
| `GET` | `/api/businesses` | Elenco delle attività, ciascuna con la sua `category` |
| `GET` | `/api/businesses/{slug}` | Dettaglio di un'attività con `category` e `distinctive_traits`; `404` se lo slug non esiste |
| `GET` | `/api/categories` | Elenco delle categorie |

Le risposte hanno sempre la stessa forma:

```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Panificio Il Grano Antico",
    "slug": "panificio-il-grano-antico",
    "story": "…",
    "address": "Via del Forno 3, Bologna",
    "contact": "051 123 4567",
    "cover_image": "businesses/panificio-il-grano-antico.jpg",
    "cover_image_url": "http://127.0.0.1:8000/storage/businesses/panificio-il-grano-antico.jpg",
    "category": { "id": 2, "name": "Cibo e ristorazione", "slug": "cibo-e-ristorazione" },
    "distinctive_traits": [{ "id": 1, "name": "Fatto a mano" }]
  }
}
```

(Esempio abbreviato: le risposte reali includono anche `category_id`, `created_at` e `updated_at`, e i tratti contengono i campi della tabella pivot.)

**CORS.** L'API accetta richieste solo dall'origine `http://localhost:5173` e solo per i percorsi `api/*` (configurazione in `config/cors.php`). Il frontend va aperto da quell'indirizzo. In produzione l'origine va sostituita con quella del sito reale.

## Rotte del backoffice

Tutte richiedono il login (middleware `auth`).

| Risorsa | Percorsi |
|---|---|
| Dashboard | `/dashboard` |
| Attività | `/businesses` (elenco), `/businesses/create`, `/businesses/{id}/edit` |
| Categorie | `/categories`, `/categories/create`, `/categories/{id}/edit` |
| Tratti distintivi | `/distinctive-traits`, `/distinctive-traits/create`, `/distinctive-traits/{id}/edit` |
| Profilo | `/profile` |

## Test

> **Attenzione.** `phpunit.xml` non definisce un database di test separato, quindi `php artisan test` usa il database MySQL configurato in `.env`. I test di autenticazione usano `RefreshDatabase`, che **cancella e ricrea le tabelle**: se li lanci sul database con i dati di esempio, li perdi (si recuperano con `php artisan migrate --seed`).
>
> Prima di eseguirli, crea un database MySQL dedicato e indicalo per i test (per esempio con `DB_DATABASE` nella sezione `<php>` di `phpunit.xml`).

```bash
php artisan test
```

I test girano su MySQL, non su SQLite.

## Struttura del progetto

```
app/
  Http/Controllers/Admin/   controller CRUD del backoffice
  Http/Controllers/Api/     controller di sola lettura per l'API
  Models/                   Business, Category, DistinctiveTrait
database/
  migrations/               schema del database
  seeders/                  dati di esempio
public/images/seed-businesses/   immagini usate dal seeder
resources/
  views/                    viste Blade (backoffice, autenticazione)
  scss/                     stili Bootstrap personalizzati
routes/
  web.php                   rotte del backoffice
  api.php                   rotte dell'API (prefisso /api)
config/cors.php             origine consentita per il frontend
docs/screenshots/           immagini usate in questo README
```

## Scelte progettuali

- **Backoffice solo Blade**, come richiesto dal brief; il frontend pubblico è un progetto separato che parla con l'API.
- **Validazione nei controller** con `$request->validate()`, senza classi dedicate, per tenere il codice semplice.
- **Slug generato con `Str::slug()`** a partire dal nome, per avere indirizzi leggibili.
- **Nessuna autenticazione sull'API**: i dati sono pubblici e in sola lettura.
- **Eager loading** (`with()`) per caricare categoria e tratti senza una query per ogni riga.
