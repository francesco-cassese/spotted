<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Category;
use App\Models\DistinctiveTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $businesses = [
            [
                'name' => 'Panificio Il Grano Antico',
                'story' => "Il lievito madre di Giulia Ferri ha più di sessant'anni: lo ha ereditato dalla nonna e non l'ha mai lasciato spegnere. Alle quattro del mattino il forno è già acceso, e il pane esce lento, dopo una notte intera di lievitazione. Per questo il pane resta fragrante per giorni.",
                'address' => 'Via del Forno 3, Bologna',
                'phone_number' => '051 123 4567',
                'category' => 'Cibo e ristorazione',
                'traits' => ['Fatto a mano', 'Tramandato da generazioni'],
                'image' => 'panificio-il-grano-antico.jpg',
            ],
            [
                'name' => 'Trattoria Da Elvira',
                'story' => "Elvira cucinava per i vicini dalla cucina di casa, in vicolo delle Rose, finché le tavolate sono diventate una trattoria. Oggi i nipoti servono ancora il ragù della domenica con la sua ricetta, scritta a penna su un quaderno che nessuno ha il permesso di correggere. I tavoli sono pochi e la pasta si tira a mano ogni mattina, per questo si viene solo su prenotazione. Chi si siede a tavola mangia come a casa di Elvira, con gli stessi sapori di sempre.",
                'address' => 'Vicolo delle Rose 5, Napoli',
                'phone_number' => '081 234 5678',
                'category' => 'Cibo e ristorazione',
                'traits' => ['Tramandato da generazioni', 'Solo su prenotazione'],
                'image' => 'trattoria-da-elvira.jpg',
            ],
            [
                'name' => 'Sartoria Marchetti',
                'story' => "Aldo Marchetti ha imparato a tagliare la stoffa a quattordici anni, come garzone in una bottega di Torino. Oggi ogni abito nasce da tre prove e da un modello disegnato sul cliente, senza scorciatoie: il gessetto è ancora quello di quarant'anni fa. Un abito Marchetti veste bene perché è fatto sul tuo corpo e non su una taglia.",
                'address' => 'Corso Vittorio Emanuele 45, Torino',
                'phone_number' => '011 345 6789',
                'category' => 'Artigianato',
                'traits' => ['Su misura', 'Fatto a mano'],
                'image' => 'sartoria-marchetti.jpg',
            ],
            [
                'name' => 'Falegnameria Conti',
                'story' => "Il banco da lavoro è quello di nonno Ettore, con i segni di tre generazioni di pialle. Marco Conti sceglie le tavole una a una, le lascia stagionare per anni e costruisce mobili che, dice, dureranno più di lui. Ognuno è disegnato insieme a chi lo ha ordinato. Per questo entra nella stanza per cui è nato e ci resta per generazioni.",
                'address' => "Via dell'Artigianato 8, Bergamo",
                'phone_number' => '035 456 7890',
                'category' => 'Artigianato',
                'traits' => ['Fatto a mano', 'Su misura', 'Tramandato da generazioni'],
                'image' => 'falegnameria-conti.jpg',
            ],
            [
                'name' => 'Centro Estetico Bellavita',
                'story' => "Chiara ha aperto Bellavita dopo dieci anni nelle grandi catene, per lavorare con calma: una cliente alla volta, senza fretta. Le cabine sono tre, i prodotti sono a base di ingredienti naturali e i barattoli vuoti si riportano indietro per essere riempiti di nuovo. Si viene solo su appuntamento. Chi entra ha la cabina e il tempo solo per sé, e sa cosa c'è nei prodotti che usa.",
                'address' => 'Via Roma 12, Milano',
                'phone_number' => '02 567 8901',
                'category' => 'Cura della persona',
                'traits' => ['Solo su prenotazione', 'Sostenibile'],
                'image' => 'centro-estetico-bellavita.jpg',
            ],
            [
                'name' => 'Studio Legale Rinaldi',
                'story' => "L'avvocato Rinaldi ha iniziato in uno studio grande, dove non aveva mai il tempo di ascoltare. Nel 2012 ha aperto il suo in via Garibaldi, con una regola: il primo colloquio serve a capire, non a fatturare. Segue cause civili e di lavoro e riceve solo su appuntamento, per dedicare a ognuno il tempo che serve. Con lui si sa fin dal primo incontro cosa aspettarsi e quanto costerà.",
                'address' => 'Via Garibaldi 22, Firenze',
                'phone_number' => '055 678 9012',
                'category' => 'Servizi',
                'traits' => ['Solo su prenotazione'],
                'image' => 'studio-legale-rinaldi.jpg',
            ],
            // Le ultime tre non hanno una sede: due lavorano a domicilio, una vende solo online.
            // Le foto non ci sono ancora: se manca il file il seeder salva il negozio senza immagine
            [
                'name' => 'Ciclofficina Volante',
                'story' => "Marta ripara biciclette senza avere un negozio: arriva con il furgone e gli attrezzi sotto casa tua, e la bici la sistema mentre prendi il caffè. Ha iniziato dal garage del padre, poi ha capito che a molti manca il tempo di portare la bici in officina. Per questo va lei da loro, su appuntamento.",
                'address' => null,
                'phone_number' => '347 890 1234',
                'website' => 'https://www.example.com/ciclofficina-volante',
                'category' => 'Servizi',
                'traits' => ['A domicilio', 'Solo su prenotazione'],
                'image' => 'ciclofficina-volante.jpg',
            ],
            [
                'name' => 'Ceramiche Lina',
                'story' => "Lina modella ogni tazza al tornio nel suo laboratorio di casa e la vende solo online: niente vetrina, niente magazzino. Ogni pezzo è unico e parte con un biglietto scritto a mano. Se hai in mente un colore o una misura, glielo scrivi dal sito e lei la realizza per te.",
                'address' => null,
                'phone_number' => '320 456 7890',
                'website' => 'https://www.example.com/ceramiche-lina',
                'category' => 'Artigianato',
                'traits' => ['Fatto a mano', 'Su misura'],
                'image' => 'ceramiche-lina.jpg',
            ],
            [
                'name' => 'Giada a Domicilio',
                'story' => "Giada fa la parrucchiera da quindici anni e da qualche tempo lavora solo a casa dei clienti, con una valigia di strumenti e prodotti naturali. Chi non può uscire, per l'età o per gli orari, la chiama e lei arriva. Si prende tutto il tempo che serve e non ha una sede da mantenere.",
                'address' => null,
                'phone_number' => '340 123 4567',
                'website' => null,
                'category' => 'Cura della persona',
                'traits' => ['A domicilio', 'Sostenibile', 'Solo su prenotazione'],
                'image' => 'giada-a-domicilio.jpg',
            ],
        ];

        foreach ($businesses as $data) {
            $category = Category::where('name', $data['category'])->first();

            $coverImage = null;
            $sourcePath = public_path('images/seed-businesses/' . $data['image']);
            if (file_exists($sourcePath)) {
                $coverImage = Storage::putFileAs('businesses', $sourcePath, $data['image']);
            }

            $newBusiness = new Business();
            $newBusiness->name = $data['name'];
            $newBusiness->slug = Str::slug($data['name']);
            $newBusiness->story = $data['story'];
            $newBusiness->address = $data['address'];
            $newBusiness->phone_number = $data['phone_number'];
            $newBusiness->website = $data['website'] ?? null;
            $newBusiness->cover_image = $coverImage;
            $newBusiness->category_id = $category->id;
            $newBusiness->save();

            $traits = DistinctiveTrait::whereIn('name', $data['traits'])->get();
            $newBusiness->distinctiveTraits()->attach($traits);
        }
    }
}
