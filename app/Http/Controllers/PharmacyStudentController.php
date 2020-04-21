<?php

namespace App\Http\Controllers;

use App\PharmacistStudent;
use App\PharmacyStudent;
use Illuminate\Http\Request;

class PharmacyStudentController extends Controller
{

    /**
     * Get Activation Page
     *
     * @param $activationCode
     */
    public function index($activationCode) {
        $pharmacy = PharmacyStudent::where('activation_code', $activationCode)->firstOrFail();
        return view('registration.07_pharmacy_acceptance')->with('placement', $pharmacy);
    }

    /**
     *  Validate and activate pharmacistStudent
     * @param PharmacyStudent $pharmacyStudent
     */
    public function update(PharmacyStudent $pharmacyStudent) {

        $validator = \Validator::make(request()->all(), [
            'pharmacy_declaration_1' => 'required|accepted',
            'pharmacy_declaration_2' => 'required|accepted',
            'pharmacy_reg_number' => [
                'required',
                function ($attribute, $value, $fail) use ($pharmacyStudent) {
                    if ($value !== $pharmacyStudent->pharmacy->registration_number) {
                        $fail('Registration Number is invalid.');
                    }
                },
            ]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 500);
        }

        $pharmacyStudent->active = true;
        $pharmacyStudent->save();

        return response()->json($pharmacyStudent, 200);

    }
}
