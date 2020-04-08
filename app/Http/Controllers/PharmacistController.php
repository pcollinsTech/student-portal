<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    public function acceptanceForm(Request $request, $id)
    {
        $student = Student::findOrFail($id);

       
        
        return view('registration.07_pharmacist_acceptance')
            ->with('student', json_decode($student, true))
            ->with("placement_start", "2020-07-15");
    }
}
