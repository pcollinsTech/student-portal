<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Pharmacist;

class UpdatePharmacistData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:pharmacists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Updated Pharacist information';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $key = env('MAIN_DB_API_KEY');

        $client = new Client(['X-Api-Key' => $key]);

        $res = $client->get('https://staging.psni.org.uk/api/pharmacist/get-pharmacist-details', [
            'headers' => [
                'X-Api-Key' => $key
            ]
        ]);

        $data = json_decode($res->getBody());

        foreach ($data as $pharmacist) {

            Pharmacist::updateOrCreate(['id' => $pharmacist->id], [
                "title" => $pharmacist->pharmacistTitle,
                "forenames" => $pharmacist->forenames,
                "surname" => $pharmacist->surname,
                "email" => $pharmacist->email,
            ]);
        }

    }
}
