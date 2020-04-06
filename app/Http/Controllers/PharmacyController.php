<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PharmaciesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Pharmacy;
use App\Student;

class PharmacyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new PharmaciesImport,request()->file('file'));
           
        return back();
    }

    public function acceptanceForm(Request $request, $id)
    {
        $student = Student::findOrFail($id);

       
        
        return view('registration.06_pharmacy_acceptance', compact($student));
    }
}
