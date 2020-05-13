<?php

namespace App\DataLogic;

use App\Document;
use App\Helpers\File;
use App\Helpers\Response;
use App\PharmacistStudent;
use App\PharmacyStudent;
use App\Registration;
use App\Rules\CheckKeyValue;
use App\Rules\DocumentsRequired;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Applications
{

  public function process($step)
  {

    switch ($step) {
        // Profile 
      case 1:
        request()->validate($this->getProfileRules(), $this->validationMessages());
        break;

      case 2:
        request()->validate($this->getDeclarationsRules(), $this->validationDeclarationMessages());
        break;

      case 3:
        request()->validate($this->getPlacementsRules('pharmacies', 0), $this->getPlacementsValidationMessages());
        request()->validate($this->getPlacementsRules('pharmacies', 1), $this->getPlacementsValidationMessages());
        request()->validate($this->getPlacementsRules('tutors', 0), $this->getPlacementsValidationMessages());
        request()->validate($this->getPlacementsRules('tutors', 1), $this->getPlacementsValidationMessages());
        break;

      case 4:
        request()->validate($this->getDocumentRules(), $this->getDocumentsValidationMessages());

        break;
    }

    if ($step < 5)
      return;

    try {


      $user = new User();



      // Create the User
      if (!isset(request()->user_id)) {

        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->type = 'student';
        $user->save();

        $student = new Student();
      } else {
        $user = User::find(request()->user_id);
        $student = Student::find(request()->id);
      }

      $student->fill(request()->all());

      $student->user_id = $user->id;

      $student->previous_training = request()->previous_training['checked'];
      $student->previous_training_details = request()->previous_training['details'];

      $terms = [
        'declaration_1' => request()->declaration_1['checked'] ? 'true' : 'false',
        'declaration_2' => request()->declaration_2['checked'] ? 'true' : 'false',
        'declaration_3' => request()->declaration_3['checked'] ? 'true' : 'false',
        'declaration_4' => request()->declaration_4['checked'] ? 'true' : 'false',
        'declaration_5' => request()->declaration_5['checked'] ? 'true' : 'false',
      ];

      $student->terms = $terms;
      $student->save();


      // Save Resgistration and Documents
      $this->saveRegistration($student);


      // Save Pharmacies
      collect(request()->pharmacies)->each(function ($pharmacie) use ($student) {

        $pharmacyStudent = PharmacyStudent::where('student_id',  $student->id)->where('pharmacy_id', $pharmacie['id'])->first();

        if ($pharmacyStudent === null) {
          $pharmacieStudent = new PharmacyStudent();
          $pharmacieStudent->pharmacy_id = $pharmacie['id'];
          $pharmacieStudent->student_id = $student->id;
          $pharmacieStudent->placement_start = $pharmacie['placement_start'];
          $pharmacieStudent->placement_end = $pharmacie['placement_end'];
          $pharmacieStudent->save();
        }
      });

      // Map pharmacies IDs
      $pharmaciesIds = collect(request()->pharmacies)->map(function ($pharmacy) {

        return $pharmacy['id'];
      });

      // Find all pharmacies that are not in the request list
      $pharmaciesToDelete = PharmacyStudent::where('student_id',  $student->id)->whereNotIn('pharmacy_id', $pharmaciesIds)->get()->map(function ($pharmacy) {

        return $pharmacy['id'];
      });

      // Delete Pharmacies not used anymore
      PharmacyStudent::destroy($pharmaciesToDelete);



      // Save Pharmacists
      collect(request()->tutors)->each(function ($tutor) use ($student) {

        $pharmacistStudent = PharmacistStudent::where('student_id',  $student->id)->where('pharmacist_id', $tutor['id'])->first();

        if ($pharmacistStudent === null) {

          $pharmacistStudent = new PharmacistStudent();
          $pharmacistStudent->student_id = $student['id'];
          $pharmacistStudent->pharmacist_id = $tutor['id'];
          $pharmacistStudent->tutor_start = $tutor['tutor_start'];
          $pharmacistStudent->tutor_end = $tutor['tutor_end'];
          $pharmacistStudent->save();
        }
      });


      // Map tuts IDs
      $tutorsIds = collect(request()->tutors)->map(function ($tutor) {

        return $tutor['id'];
      });


      // Find all pharmacies that are not in the request list
      $pharmacistsIds = PharmacistStudent::where('student_id',  $student->id)->whereNotIn('pharmacist_id', $tutorsIds)->get()->map(function ($pharmacist) {

        return $pharmacist['id'];
      });

      // Delete Pharmacists not used anymore
      PharmacistStudent::destroy($pharmacistsIds);


      return Response::Success('Application Submited with Sucess', $student);
    } catch (\Exception $ex) {

      return Response::Error('An Error ocurred when submiting you application ,please try again alter', $ex->getMessage());
    }
  }
  public function validationMessages()
  {

    $messages = [
      'postcode.required'                                   => 'Enter a UK :attribute',
      'home_address_1.required'                       => ':attribute is required.',
      'required'                                      => ':attribute is required.',
      'entry_date.before'                             => 'The :attribute must be a date more than 4 years ago.',
      'entry_date.after'                              => 'The :attribute must be a date in the past 7 years.',
      '__previous_training__details.required_if'      => ':attribute is required when Previous Pre-Reg Training has been undertaken.',
      'accepted'                                      => 'You must agree to the above statement.',
      'declaration_1.checked.required'                         => 'You must agree to the above statement',
      'declaration_2.checked.required'                         => 'You must agree to the above statement',
      'declaration_3.checked.required'                         => 'You must agree to the above statement',
      'declaration_4.checked.required'                         => 'You must agree to the above statement',
      'declaration_5.checked.required'                         => 'You must agree to the above statement',
      'declaration_6.checked.required'                         => 'You must agree to the above statement'
    ];

    return $messages;
  }

  public function getProfileRules()
  {

    $rules = [
      'title'                                         => ['required', 'string', 'max:4'],
      'forenames'                                     => ['required', 'string', 'max:255'],
      'surname'                                       => ['required', 'string', 'max:255'],
      'date_of_birth'                                 => ['required', 'date', 'before:-18 years'],
      'password'                                      => ['required', 'string', 'min:8', 'confirmed'],

      'home_address_1'                                => ['required', 'string', 'max:255'],
      'city'                                          => ['required', 'string', 'max:255'],
      'county'                                        => ['required', 'string', 'max:255'],
      'postcode'                                      => ['required', 'postal_code:GB', 'string', 'max:255'],
      // 'phone_mobile'                                  => ['required', 'phone:GB,mobile'],
      'phone_mobile'                                  => ['required'],
      'phone_home'                                    => ['sometimes', 'nullable', 'phone:GB'],

      'university_id'                                 => ['required', 'numeric'],
      'entry_date'                                    => ['required', 'date', 'before:-4 years', 'after:-7 years'],
      'completion_date'                               => ['required', 'date'],
      '__previous_training__details'                  => ['required_if:previous_training,yes'],


      'declaration_1.checked' => 'required|accepted',
      'declaration_2.checked' => 'required|accepted',
      'declaration_3.checked' => 'required|accepted',
      'declaration_4.checked' => 'required|accepted',
      'declaration_5.checked' => 'required|accepted',
    ];

    if (request()->id > 0) {
      $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,' . request()->user_id];

      if (strlen(request()->password) > 0)
        $rules['password'] = ['string', 'min:8', 'confirmed'];
      else
        unset($rules['password']);
    } else
      $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];

    return $rules;
  }


  public function getDeclarationsRules()
  {

    $rules = [
      'character_declaration_9.checked' => 'required',
      'health_declaration_1.checked' => 'required',
      'health_declaration_2.checked' => 'required',
      'health_declaration_3.checked' => 'required',
      'health_declaration_4.checked' => 'required',
      'health_declaration_5.checked' => 'required',
      'health_declaration_6.checked' => 'required',

    ];

    return $rules;
  }

  public function validationDeclarationMessages()
  {

    $messages = [
      'accepted' => 'You must agree to the above statement.',
      'character_declaration_9.checked.required' => 'You must agree to the above statement',
      'health_declaration_1.checked.required' => 'You must agree to the above statement',
      'health_declaration_2.checked.required' => 'You must agree to the above statement',
      'health_declaration_3.checked.required' => 'You must agree to the above statement',
      'health_declaration_4.checked.required' => 'You must agree to the above statement',
      'health_declaration_5.checked.required' => 'You must agree to the above statement',
      'health_declaration_6.checked.required' => 'You must agree to the above statement',
    ];

    return $messages;
  }

  public function getPlacementsRules($key, $index = 0)
  {

    $rules = [
      $key => new CheckKeyValue($index, 'id')
    ];

    return $rules;
  }

  public function getPlacementsValidationMessages()
  {

    $messages = [
      'pharmacies.min' => 'At least one pharmacies should be selected',
      'tutors.min' => 'At least one tutor should be selected'
    ];

    return $messages;
  }

  public function getDocumentRules()
  {

    if (request()->id > 0) {

      $student = Student::with('registration.documents')->find(request()->id);

      if ($student->documents->count() > 0)
        return [];
    }

    $rules = [
      'documents.birth_certificate' => new DocumentsRequired('birth_certificate'),
      'documents.proof_identity' => new DocumentsRequired('proof_identity'),
      'documents.passport_photograph' => new DocumentsRequired('passport_photograph'),
      'documents.degree_certificate' => new DocumentsRequired('degree_certificate'),
    ];

    return $rules;
  }

  public function getDocumentsValidationMessages()
  {

    $messages = [
      'documents.required' => 'Document are required',
    ];

    return $messages;
  }

  public function saveDocuments($registration)
  {


    $documents = request()->get('documents');


    // Save Birth Certificate
    if (isset($documents['birth_certificate'])) {

      // Delete all Previous Registrations
      $existing_document = Document::where('registration_id', $registration->id)->where('file_type', 'birth_certificate')->first();

      // Save the File into Disk
      $fileData = $documents['birth_certificate'];
      $fileData['name'] = Str::random(38) . '.' . $fileData['extension'];
      $file = new File($fileData);
      $file->save('supporting_docs');

      // Save the File into Database
      $document = new Document();
      $document->registration_id = $registration->id;
      $document->file_path = $file->path;
      $document->file_type = $fileData['type'];
      $document->file_status = 'active';
      $document->save();


      // Delete previous Document
      if ($existing_document != null) {

        Storage::disk('local')->delete($existing_document->file_path);
        $existing_document->delete();
      }
    }


    // Save Proof Identity
    if (isset($documents['proof_identity'])) {

      // Delete all Previous Registrations
      $existing_document = Document::where('registration_id', $registration->id)->where('file_type', 'proof_identity')->first();


      // Save the File into Disk
      $fileData = $documents['proof_identity'];
      $fileData['name'] = Str::random(38) . '.' . $fileData['extension'];
      $file = new File($fileData);
      $file->save('supporting_docs');

      // Save the File into Database
      $document = new Document();
      $document->registration_id = $registration->id;
      $document->file_path = $file->path;
      $document->file_type = $fileData['type'];
      $document->file_status = 'active';
      $document->save();


      // Delete previous Document
      if ($existing_document != null) {

        Storage::disk('local')->delete($existing_document->file_path);
        $existing_document->delete();
      }
    }


    // Save Proof Identity
    if (isset($documents['passport_photograph'])) {

      // Delete all Previous Registrations
      $existing_document = Document::where('registration_id', $registration->id)->where('file_type', 'passport_photograph')->first();


      // Save the File into Disk
      $fileData = $documents['passport_photograph'];
      $fileData['name'] = Str::random(38) . '.' . $fileData['extension'];
      $file = new File($fileData);
      $file->save('supporting_docs');

      // Save the File into Database
      $document = new Document();
      $document->registration_id = $registration->id;
      $document->file_path = $file->path;
      $document->file_type = $fileData['type'];
      $document->file_status = 'active';
      $document->save();


      // Delete previous Document
      if ($existing_document != null) {

        Storage::disk('local')->delete($existing_document->file_path);
        $existing_document->delete();
      }
    }


    // Save Proof Identity
    if (isset($documents['degree_certificate'])) {

      // Delete all Previous Registrations
      $existing_document = Document::where('registration_id', $registration->id)->where('file_type', 'degree_certificate')->first();


      // Save the File into Disk
      $fileData = $documents['degree_certificate'];
      $fileData['name'] = Str::random(38) . '.' . $fileData['extension'];
      $file = new File($fileData);
      $file->save('supporting_docs');

      // Save the File into Database
      $document = new Document();
      $document->registration_id = $registration->id;
      $document->file_path = $file->path;
      $document->file_type = $fileData['type'];
      $document->file_status = 'active';
      $document->save();


      // Delete previous Document
      if ($existing_document != null) {

        Storage::disk('local')->delete($existing_document->file_path);
        $existing_document->delete();
      }
    }
  }


  public function saveRegistration($student)
  {

    // Find previous existing registration
    $registration = Registration::where('student_id', $student->id)->first();

    if ($registration === null)
      $registration = new Registration();

    $registration->student_id = $student->id;
    $registration->payment_id = 0;

    $character_declarations = [
      'character_declaration_1' => request()->character_declaration_1['checked'] ? 'true' : 'false',
      'character_declaration_2' => request()->character_declaration_2['checked'] ? 'true' : 'false',
      'character_declaration_3' => request()->character_declaration_3['checked'] ? 'true' : 'false',
      'character_declaration_4' => request()->character_declaration_4['checked'] ? 'true' : 'false',
      'character_declaration_5' => request()->character_declaration_5['checked'] ? 'true' : 'false',
      'character_declaration_6' => request()->character_declaration_6['checked'] ? 'true' : 'false',
      'character_declaration_7' => request()->character_declaration_7['checked'] ? 'true' : 'false',
      'character_declaration_8' => request()->character_declaration_8['checked'] ? 'true' : 'false',
      'character_declaration_9' => request()->character_declaration_9['checked'] ? 'true' : 'false',
    ];

    $registration->character_declarations = $character_declarations;


    $character_declaration_details = [
      'character_declaration_1' => request()->character_declaration_1['details'],
      'character_declaration_2' => request()->character_declaration_2['details'],
      'character_declaration_3' => request()->character_declaration_3['details'],
      'character_declaration_4' => request()->character_declaration_4['details'],
      'character_declaration_5' => request()->character_declaration_5['details'],
      'character_declaration_6' => request()->character_declaration_6['details'],
      'character_declaration_7' => request()->character_declaration_7['details'],
      'character_declaration_8' => request()->character_declaration_8['details'],
      'character_declaration_9' => request()->character_declaration_9['details'],
    ];


    $registration->character_declaration_details = $character_declaration_details;


    $health_declarations = [
      'health_declaration_1' => request()->health_declaration_1['checked'] ? 'true' : 'false',
      'health_declaration_2' => request()->health_declaration_2['checked'] ? 'true' : 'false',
      'health_declaration_3' => request()->health_declaration_3['checked'] ? 'true' : 'false',
      'health_declaration_4' => request()->health_declaration_4['checked'] ? 'true' : 'false',
      'health_declaration_5' => request()->health_declaration_5['checked'] ? 'true' : 'false',
      'health_declaration_6' => request()->health_declaration_6['checked'] ? 'true' : 'false',
    ];

    $registration->health_declarations = $health_declarations;

    $registration->status = '';

    $registration->save();

    // Save the Documents
    $this->saveDocuments($registration);
  }
}
