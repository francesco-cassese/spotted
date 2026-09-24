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
                'contact' => '051 123 4567',
                'category' => 'Cibo e ristorazione',
                'traits' => ['Fatto a mano', 'Tramandato da generazioni'],
                'image' => 'panificio-il-grano-antico.jpg',
            ],
            [
                'name' => 'Trattoria Da Elvira',
                'story' => "Elvira cucinava per i vicini dalla cucina di casa, in vicolo delle Rose, finché le tavolate sono diventate una trattoria. Oggi i nipoti servono ancora il ragù della domenica con la sua ricetta, scritta a penna su un quaderno che nessuno ha il permesso di correggere. I tavoli sono pochi e la pasta si tira a mano ogni mattina, per questo si viene solo su prenotazione. Chi si siede a tavola mangia come a casa di Elvira, con gli stessi sapori di sempre.",
                'address' => 'Vicolo delle Rose 5, Napoli',
                'contact' => '081 234 5678',
                'category' => 'Cibo e ristorazione',
                'traits' => ['Tramandato da generazioni', 'Solo su prenotazione'],
                'image' => 'trattoria-da-elvira.jpg',
            ],
            [
                'name' => 'Sartoria Marchetti',
                'story' => "Aldo Marchetti ha imparato a tagliare la stoffa a quattordici anni, come garzone in una bottega di Torino. Oggi ogni abito nasce da tre prove e da un modello disegnato sul cliente, senza scorciatoie: il gessetto è ancora quello di quarant'anni fa. Un abito Marchetti veste bene perché è fatto sul tuo corpo e non su una taglia.",
                'address' => 'Corso Vittorio Emanuele 45, Torino',
                'contact' => '011 345 6789',
                'category' => 'Artigianato',
                'traits' => ['Su misura', 'Fatto a mano'],
                'image' => 'sartoria-marchetti.jpg',
            ],
            [
                'name' => 'Falegnameria Conti',
                'story' => "Il banco da lavoro è quello di nonno Ettore, con i segni di tre generazioni di pialle. Marco Conti sceglie le tavole una a una, le lascia stagionare per anni e costruisce mobili che, dice, dureranno più di lui. Ognuno è disegnato insieme a chi lo ha ordinato. Per questo entra nella stanza per cui è nato e ci resta per generazioni.",
                'address' => "Via dell'Artigianato 8, Bergamo",
                'contact' => '035 456 7890',
                'category' => 'Artigianato',
                'traits' => ['Fatto a mano', 'Su misura', 'Tramandato da generazioni'],
                'image' => 'falegnameria-conti.jpg',
            ],
            [
                'name' => 'Centro Estetico Bellavita',
                'story' => "Chiara ha aperto Bellavita dopo dieci anni nelle grandi catene, per lavorare con calma: una cliente alla volta, senza fretta. Le cabine sono tre, i prodotti sono a base di ingredienti naturali e i barattoli vuoti si riportano indietro per essere riempiti di nuovo. Si viene solo su appuntamento. Chi entra ha la cabina e il tempo solo per sé, e sa cosa c'è nei prodotti che usa.",
                'address' => 'Via Roma 12, Milano',
                'contact' => '02 567 8901',
                'category' => 'Cura della persona',
                'traits' => ['Solo su prenotazione', 'Sostenibile'],
                'image' => 'centro-estetico-bellavita.jpg',
            ],
            [
                'name' => 'Studio Legale Rinaldi',
                'story' => "L'avvocato Rinaldi ha iniziato in uno studio grande, dove non aveva mai il tempo di ascoltare. Nel 2012 ha aperto il suo in via Garibaldi, con una regola: il primo colloquio serve a capire, non a fatturare. Segue cause civili e di lavoro e riceve solo su appuntamento, per dedicare a ognuno il tempo che serve. Con lui si sa fin dal primo incontro cosa aspettarsi e quanto costerà.",
                'address' => 'Via Garibaldi 22, Firenze',
                'contact' => '055 678 9012',
                'category' => 'Servizi',
                'traits' => ['Solo su prenotazione'],
                'image' => 'studio-legale-rinaldi.jpg',
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
            $newBusiness->contact = $data['contact'];
            $newBusiness->cover_image = $coverImage;
            $newBusiness->category_id = $category->id;
            $newBusiness->save();

            $traits = DistinctiveTrait::whereIn('name', $data['traits'])->get();
            $newBusiness->distinctiveTraits()->attach($traits);
        }
    }
}
