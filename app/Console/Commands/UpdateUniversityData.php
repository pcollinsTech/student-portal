<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\University;

class UpdateUniversityData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:universities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Updated University information';

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

        $client = new Client();

        $res = $client->get('https://staging.psni.org.uk/api/university/get-university-details', [
            'headers' => [
                'X-Api-Key' => $key
            ]
        ]);

        $data = json_decode($res->getBody());

        foreach ($data as $university) {

            University::updateOrCreate(['name' => $university->name], [
                "name" => $university->name,
            ]);
        }
    }
}
