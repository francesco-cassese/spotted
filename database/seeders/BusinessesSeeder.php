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
                'story' => 'Panificio a conduzione familiare che sforna ogni mattina pane e prodotti da forno seguendo una lievitazione lenta e naturale, come si faceva una volta.',
                'address' => 'Via del Forno 3, Bologna',
                'contact' => '051 123 4567',
                'category' => 'Cibo e ristorazione',
                'traits' => ['Fatto a mano', 'Tramandato da generazioni'],
                'image' => 'panificio-il-grano-antico.jpg',
            ],
            [
                'name' => 'Trattoria Da Elvira',
                'story' => 'Trattoria di quartiere che propone piatti della tradizione locale, cucinati seguendo le ricette tramandate da Elvira alla sua famiglia.',
                'address' => 'Vicolo delle Rose 5, Napoli',
                'contact' => '081 234 5678',
                'category' => 'Cibo e ristorazione',
                'traits' => ['Tramandato da generazioni', 'Solo su prenotazione'],
                'image' => 'trattoria-da-elvira.jpg',
            ],
            [
                'name' => 'Sartoria Marchetti',
                'story' => 'Sartoria artigianale specializzata in abiti da uomo su misura, realizzati a mano capo per capo su richiesta del cliente.',
                'address' => 'Corso Vittorio Emanuele 45, Torino',
                'contact' => '011 345 6789',
                'category' => 'Artigianato',
                'traits' => ['Su misura', 'Fatto a mano'],
                'image' => 'sartoria-marchetti.jpg',
            ],
            [
                'name' => 'Falegnameria Conti',
                'story' => 'Falegnameria di famiglia, giunta alla terza generazione, che realizza mobili su misura in legno massello con tecniche tradizionali.',
                'address' => "Via dell'Artigianato 8, Bergamo",
                'contact' => '035 456 7890',
                'category' => 'Artigianato',
                'traits' => ['Fatto a mano', 'Su misura', 'Tramandato da generazioni'],
                'image' => 'falegnameria-conti.jpg',
            ],
            [
                'name' => 'Centro Estetico Bellavita',
                'story' => 'Centro estetico che offre trattamenti di bellezza e benessere personalizzati, con prodotti attenti alla sostenibilità.',
                'address' => 'Via Roma 12, Milano',
                'contact' => '02 567 8901',
                'category' => 'Cura della persona',
                'traits' => ['Solo su prenotazione', 'Sostenibile'],
                'image' => 'centro-estetico-bellavita.jpg',
            ],
            [
                'name' => 'Studio Legale Rinaldi',
                'story' => 'Studio legale specializzato in diritto civile e del lavoro, che segue i propri assistiti con consulenze personalizzate.',
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
