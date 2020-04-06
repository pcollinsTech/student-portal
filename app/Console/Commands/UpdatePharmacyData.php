<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Pharmacy;

class UpdatePharmacyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:pharmacies';

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

        $res = $client->get('https://staging.psni.org.uk/api/pharmacy/get-pharmacy-details', [
            'headers' => [
                'X-Api-Key' => $key
            ]
        ]);

        $data = json_decode($res->getBody());

        foreach ($data as $pharmacy) {

            if($pharmacy->postCode == null){
                return $pharmacy->postCode == "unknown";
            };

            Pharmacy::updateOrCreate(['id' => $pharmacy->id], [
                "trading_name" => $pharmacy->name,
                "address_1" => $pharmacy->address1,
                "town" => $pharmacy->town,
                "county" => $pharmacy->county,
                "post_code" => $pharmacy->postCode,
                "verified" => true
            ]);
        }

    }
}
