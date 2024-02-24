<?php

namespace Database\Seeders;

use App\Models\Book;
// use App\Services\EsService;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new Client();
        $stateQuery = $client->get('https://fakerapi.it/api/v1/books?_quantity=1000');
        $Data = $stateQuery->getBody();
        $Data = json_decode($Data, true)['data'];
        // $es = new EsService();
        foreach ($Data as  $value) {

            Book::create($value);
            // $es->create($value);

        }


    }
}
