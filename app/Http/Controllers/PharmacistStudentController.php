<?php

namespace App\Http\Controllers;

use App\PharmacistStudent;
use Illuminate\Http\Request;

class PharmacistStudentController extends Controller
{

    /**
     * Get Activation Page
     *
     * @param $activationCode
     */
    public function index($activationCode) {
        $tutor = PharmacistStudent::where('activation_code', $activationCode)->firstOrFail();

        return view('registration.08_tutor_acceptance')->with(
            'tutor', $tutor
        );
    }


    /**
     * Validate and activate pharmacistStudent
     *
     * @param PharmacistStudent $pharmacistStudent
     */
    public function update(PharmacistStudent $pharmacistStudent) {

    }

}
