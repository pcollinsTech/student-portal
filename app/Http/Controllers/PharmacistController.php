<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    public function acceptanceForm(Request $request, $id)
    {
        $student = Student::findOrFail($id);

       
        
        return view('registration.07_pharmacist_acceptance', compact($student));
    }
}
