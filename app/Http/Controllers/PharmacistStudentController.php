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
        $validator = \Validator::make(request()->all(), [
            'pharmacy_declaration_1' => 'required|accepted',
            'pharmacy_declaration_2' => 'required|accepted',
            'pharmacy_declaration_3' => 'required|accepted',
            'pharmacy_declaration_4' => 'required|accepted',
            'pharmacy_declaration_5' => 'required|accepted',
            'pharmacist_reg_number' => [
                'required',
                function ($attribute, $value, $fail) use ($pharmacistStudent) {
                    if ($value !== $pharmacistStudent->pharmacist->registration_number) {
                        $fail('Registration Number is invalid.');
                    }
                },
            ]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 500);
        }
        $pharmacistStudent->active = true;
        $pharmacistStudent->save();
        return response()->json($pharmacistStudent, 200);
    }

}
