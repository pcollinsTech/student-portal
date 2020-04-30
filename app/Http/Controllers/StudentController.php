<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function postStudent($id)
    {
        // Setup CLient
        $key = env('MAIN_DB_API_KEY');

        $client = new Client(['X-Api-Key' => $key]);

        // Get data for sending
        $user = User::findOrfail($id);

        $student = $user->student();

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
