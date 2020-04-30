<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PostVerifiedStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:student {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //// Setup CLient
        $key = env('MAIN_DB_API_KEY');

        $client = new Client(['X-Api-Key' => $key]);

        // Get data for sending
        $user = User::findOrfail($id);

        $student = $user->student();

        // This isn't right..
        $placementsData = $student->placements()->get();
              
        $placments = [];

        foreach($placementsData as $placement)
        {
            $placements[] = [
                "StartDate" => $placement->tutor_start,
                "EndDate" => $placement->tutor_end,
                "StudentLetter" => $placement->tutor_start,
                "TutorLetter" => $placement->tutor_start,
                "TutorID" => $placement->pharmacist_id,
                "Email" => $placement->tutor_start,
            ];
        }

        $data = [
            "Surname" =>  $student->surname,
            "Forenames" =>   $student->fornames,
            "StudentTitle" => $student->title,
            "Gender" => $student->gender,
            "AddressLine1" => $student->home_address_1,
            "Town" => $student->city,
            "Email" => $user->email,
            "Placements" => $placmenets

        ];

        // Send data

        $res = $client->post('https://staging.psni.org.uk/api/student/submit-student-details', [
            'headers' => [
                'X-Api-Key' => $key
            ], 
            ['body' => json_encode($data)]
        ]);

        $response = json_decode($res->getBody());
    }
}
