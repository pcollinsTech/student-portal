<?php

namespace App\Http\Controllers;

use App\Document;
use App\Pharmacy;
use App\Pharmacist;
use App\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Student;
use App\User;
use Mail;
use App\Mail\PharmacyAcceptanceMail;
use App\Mail\PharmacistAcceptanceMail;


class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'registration.open', 'user.student'] );
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showRegistrationForm()
    {
        if(Auth::check()) {

            $user_status = Auth::user()->status;
            $student = Auth::user()->student;
            $registration = $student->registration;

//        Create Registration if does not exist
        if($registration == null) {
            $registration = Registration::create([
                'student_id' => $student->id,
                'payment_id' => 0,
                'character_declarations' => json_encode([]),
                'character_declaration_details' => json_encode([]),
                'health_declarations' => json_encode([]),
                'status' => '',
            ]);

//            Save the registration id to the student
            $student->registration_id = $registration->id;
            $student->save();
        }
            
            $view = '';
            $variables = [];

            switch ($user_status) {
                case 'payment_required':
                    //  Set view to payment_required screen
                    $view = 'registration.01_payment';
                    break;

                case 'character_declaration_required':
//                    Set view to character_declaration_required screen
                    $view = 'registration.02_character_declaration';
                    break;

                case 'health_declaration_required':
//                    Set view to health_declaration_required screen
                    $view = 'registration.03_health_declaration';
                    break;

                
                case 'placement_details_required':
                    $pharmacies = Pharmacy::orderBy('trading_name', 'asc')->get();
                    foreach ($pharmacies as $pharmacy) {
                        $pharmacy->value = $pharmacy->id;
                        $pharmacy->display =  $pharmacy->trading_name . ' - ' . $pharmacy->registration_number . ' ' . ' (' . $pharmacy->address_1 . ", " . $pharmacy->post_code . ')';
                        $pharmacy->disabled = false;
                    }

                    $pharmacy_placeholder = new Pharmacy();
                    $pharmacy_placeholder->display = 'Select Pharmacy';
                    $pharmacy_placeholder->value = '';
                    $pharmacy_placeholder->disabled = true;

                    $pharmacies->prepend($pharmacy_placeholder);

                    $placement_start = "2020-07-15";
                    $placement_end = "2020-09-14";
                    $variables = [
                        'pharmacies',
                        'placement_start',
                        'placement_end',
                    ];
//                    Set view to placement_details_required screen
                    $view = 'registration.05_placement_details';
                    break;
                case 'tutor_details_required':
                    $tutors = Pharmacist::where('verified',true)->orderBy('surname', 'asc')->get();
                    foreach ($tutors as $tutor) {
                        $tutor->value = $tutor->id;
                        $tutor->display = $tutor->surname . ', ' . $tutor->forenames . ' (' . $tutor->registration_number . ')';
                        $tutor->disabled = false;
                    }

                    $tutor_placeholder = new Pharmacist;
                    $tutor_placeholder->display = 'Select Tutor';
                    $tutor_placeholder->value = '';
                    $tutor_placeholder->disabled = true;

                    $tutors->prepend($tutor_placeholder);

                    $tutor_start = "2020-07-15";
                    $tutor_end = "2020-09-14";
                    $variables = [
                        'tutors',
                        'tutor_start',
                        'tutor_end',
                    ];
//                    Set view to tutor_details_required screen
                    $view = 'registration.06_tutor_details';
                    break;
                case 'supporting_documents_required':
//                    Set view to supporting_documents_required screen
                    $view = 'registration.04_supporting_documents';
                    break;
                        
                case 'awaiting_acceptance':
                    $view = 'finished';
                    break;
                case 'confirmation';
                    $view="registration.confirmation";
                    break;
                default:
                $view = 'finished';
                    break;
            }

            $student = Auth::user()->student;
            $registration =  Auth::user()->student->registration;
            $variables[] = 'registration';
            $variables[] = 'student';
            return view($view, compact($variables));
        }
    }

    /**
     *  Process the Registration Form.
     */

    public function processRegistration(Request $request)
    {
        $user = $request->user();
        $student = $user->student;

//        Get the current step which has been posted to the application
        $currentStep = $request->currentStep;
        $user_status = '';
//        Find existing registration if exists
        $registration = $student->registration;

//        Create Registration if does not exist
        if($registration == null) {
            $registration = Registration::create([
                'student_id' => $student->id,
                'payment_id' => 0,
                'character_declarations' => json_encode([]),
                'character_declaration_details' => json_encode([]),
                'status' => '',
            ]);

//            Save the registration id to the student
            $student->registration_id = $registration->id;
            $student->save();
        }

        switch($currentStep) {
            case 'payment':

//                Verify payment complete

//                Store details of payment

//                Update user status
                $user_status = 'character_declaration_required';

                break;

            case 'character_declaration':

//                Validate the character declaration
                $this->character_declaration_validator($request->all())->validate();

//                Save the character declaration
                $this->character_declaration_save($registration, $request->all());

//                Update user status
                $user_status = 'health_declaration_required';

                break;

            case 'health_declaration':

//                Validate the character declaration
                $this->health_declaration_validator($request->all())->validate();

//                Save the health declaration
                $this->health_declaration_save($registration, $request->all());

//                Update user status
                $user_status = 'placement_details_required';

                break;

            case 'placement_details':
                // Add Pharmacies -> Student Relationships
                $this->set_student_placements($request->all());
            
                $user_status = 'tutor_details_required';
            
                break;
            case 'tutor_details':
                // Add Pharmacies -> Student Relationships
                    $this->set_student_tutors($request->all());
                $user_status = 'supporting_documents_required';
                break;
            case 'supporting_documents':

//                Validate the supporting documents
                $this->supporting_documents_validator($request->all())->validate();

//                Save the supporting documents
                $this->supporting_documents_save($registration, $request);

//                Update user status
                $user_status = 'confirmation';

                break;

            case 'confirmation':
                // dd('here');
                $user_status = 'awaiting_acceptance';
                break;
            default;
                $user_status = 'awaiting_acceptance';
        }

       $user->setStatus($user_status);
        if (request()->expectsJson()) return response()->json($user_status);
        return response()->redirectTo('registration');

    }

    /**
     * Get a validator for an incoming character declaration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function character_declaration_validator(array $data)
    {

        $messages = [
            'required_if' => 'Evidence is required to support your claim of good character.',
            'accepted' => 'You must agree to the above statement.'
        ];

        $attrs = [];

        return Validator::make($data, [

            '__character_declaration_1__details'=>   ['required_if:character_declaration_1,yes'],
            '__character_declaration_2__details' => ['required_if:character_declaration_2,yes'],
            '__character_declaration_3__details' => ['required_if:character_declaration_3,yes'],
            '__character_declaration_4__details' => ['required_if:character_declaration_4,yes'],
            '__character_declaration_5__details' => ['required_if:character_declaration_5,yes'],
            '__character_declaration_6__details' => ['required_if:character_declaration_6,yes'],
            '__character_declaration_7__details' => ['required_if:character_declaration_7,yes'],
            '__character_declaration_8__details' => ['required_if:character_declaration_8,yes'],
            'character_declaration_9' => ['accepted'],
        ], $messages, $attrs);
    }

    /**
     * Save student placements
     *
     * @param array $data
     */
    protected function set_student_placements(array $data)
    {
        $student = Auth::user()->student;
        $placements = [];

        // Changes to front end data format would be better than this...
        if ($data['number_of_placements'] == 1) {

            // $pharmacy = $data['placements'][0]['placement_id'][0];
            // Mail::to($pharmacy->email)->send(new PharmacyAcceptanceMail($student));
            $placements[$data['placements'][0]['placement_id'][0]] = [

                'placement_start' => Carbon::parse($data['placements'][0]['placement_start'][0])->toDateTime(),
                'placement_end' => Carbon::parse($data['placements'][0]['placement_end'][0])->toDateTime(),
            ];
        } else if ($data['number_of_placements'] > 1) {

            // $pharmacy = $data['placements'][0]['placement_id'][0];
            // $pharmacy2 = $data['placements'][0]['placement_id'][1];
            // Mail::to($pharmacy->email)->send(new PharmacyAcceptanceMail($student));
            // Mail::to($pharmacy2->email)->send(new PharmacyAcceptanceMail($student));


            $placements[$data['placements'][0]['placement_id'][0]] = [
                'placement_start' => Carbon::parse($data['placements'][0]['placement_start'][0])->toDateTime(),
                'placement_end' => Carbon::parse($data['placements'][0]['placement_end'][0])->toDateTime(),
            ];
            $placements[$data['placements'][0]['placement_id'][1]] = [
                'placement_start' => Carbon::parse($data['placements'][0]['placement_start'][1])->toDateTime(),
                'placement_end' => Carbon::parse($data['placements'][0]['placement_end'][1])->toDateTime(),
            ];
        }

        $student->pharmacies()->sync($placements);

    }

    /**
     * Save Student Tutor Data
     *
     * @param array $data
     */
    protected function set_student_tutors(array $data)
    {
        $student = Auth::user()->student;
        $pharmacists = [];
        // Changes to front end data format would be better than this...
        if ($data['number_of_tutors'] == 1) {

            // $pharmacist = $data['tutors'][0]['tutor_id'][0];
            // Mail::to($pharmacist->email)->send(new PharmacistAcceptanceMail($student));
            $pharmacists[$data['tutors'][0]['tutor_id'][0]] = [
                'tutor_start' => Carbon::parse($data['tutors'][0]['tutor_start'][0])->toDateTime(),
                'tutor_end' => Carbon::parse($data['tutors'][0]['tutor_end'][0])->toDateTime(),
            ];
        } else if ($data['number_of_tutors'] > 1) {


            // $pharmacist = $data['tutors'][0]['tutor_id'][0];
            // $pharmacist2 = $data['tutors'][0]['tutor_id'][1];
            // Mail::to($pharmacist->email)->send(new PharmacistAcceptanceMail($student));
            // Mail::to($pharmacist2->email)->send(new PharmacistAcceptanceMail($student));
            $pharmacists[$data['tutors'][0]['tutor_id'][0]] = [
                'tutor_start' => Carbon::parse($data['tutors'][0]['tutor_start'][0])->toDateTime(),
                'tutor_end' => Carbon::parse($data['tutors'][0]['tutor_end'][0])->toDateTime(),
            ];
            $pharmacists[$data['tutors'][0]['tutor_id'][1]] = [
                'tutor_start' => Carbon::parse($data['tutors'][0]['tutor_start'][1])->toDateTime(),
                'tutor_end' => Carbon::parse($data['tutors'][0]['tutor_end'][1])->toDateTime(),
            ];
        }
//        dd($student->pharmacists);
        $student->pharmacists()-> sync($pharmacists);
    }
    /**
     * Get a validator for an incoming health declaration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function health_declaration_validator(array $data)
    {

        $messages = [
            'accepted' => 'You must agree to the above statement.'
        ];

        $attrs = [];

        return Validator::make($data, [

            'health_declaration_2' => ['accepted'],
            'health_declaration_3' => ['accepted'],
            'health_declaration_4' => ['accepted'],
            'health_declaration_5' => ['accepted'],
            'health_declaration_6' => ['accepted'],
        ], $messages, $attrs);
    }

    /**
     * Get a validator for an incoming health declaration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function supporting_documents_validator(array $data)
    {
        $messages = [
          'file'=> 'You must upload your :attribute.'
        ];

        $attrs = [
            'document__birth_certificate' => 'Original Birth Certificate',
            'document__proof_identity' => 'Proof of Identity',
            'document__passport_photograph' => 'Passport Photo',
        ];

        return Validator::make($data, [

            'document__birth_certificate' => ['file'],
            'document__proof_identity'    => ['file'],
            'document__passport_photograph' => ['file'],

        ], $messages, $attrs);
    }

    /**
     * Save character declaration for incoming request.
     *
     * @param Registration $registration
     * @param array $data
     * @return bool
     */
    protected function character_declaration_save(Registration $registration, array $data)
    {

        $character_declarations = [
            'character_declaration_1' => $data['character_declaration_1'],
            'character_declaration_2' => $data['character_declaration_2'],
            'character_declaration_3' => $data['character_declaration_3'],
            'character_declaration_4' => $data['character_declaration_4'],
            'character_declaration_5' => $data['character_declaration_5'],
            'character_declaration_6' => $data['character_declaration_6'],
            'character_declaration_7' => $data['character_declaration_7'],
            'character_declaration_8' => $data['character_declaration_8'],
            'character_declaration_9' => $data['character_declaration_9'],
        ];

        $character_declaration_details = [
            'character_declaration_1' => $data['__character_declaration_1__details'],
            'character_declaration_2' => $data['__character_declaration_2__details'],
            'character_declaration_3' => $data['__character_declaration_3__details'],
            'character_declaration_4' => $data['__character_declaration_4__details'],
            'character_declaration_5' => $data['__character_declaration_5__details'],
            'character_declaration_6' => $data['__character_declaration_6__details'],
            'character_declaration_7' => $data['__character_declaration_7__details'],
            'character_declaration_8' => $data['__character_declaration_8__details'],
        ];

        $registration->character_declarations = $character_declarations;
        $registration->character_declaration_details = $character_declaration_details;

        return $registration->save();
    }

    /**
     * Save health declaration for incoming request.
     *
     * @param Registration $registration
     * @param array $data
     * @return bool
     */
    protected function health_declaration_save(Registration $registration, array $data)
    {
        $health_declarations = [
            'health_declaration_1' => $data['health_declaration_1'],
            'health_declaration_2' => $data['health_declaration_2'],
            'health_declaration_3' => $data['health_declaration_3'],
            'health_declaration_4' => $data['health_declaration_4'],
            'health_declaration_5' => $data['health_declaration_5'],
            'health_declaration_6' => $data['health_declaration_6'],
        ];

        $registration->health_declarations = $health_declarations;

        return $registration->save();
    }

    /**
     * Save supporting documents for incoming request.
     *
     * @param Registration $registration
     * @param Request $data
     * @return bool
     */
    protected function supporting_documents_save(Registration $registration, Request $data)
    {
        $documents =[];
//        Loop through and save each file
        foreach ($data->files as $key => $file) {

//            Get file type
            $file_type = explode('document__', $key)[1];

//            Generate random string file name
            $file_base = Str::random(32) . '.' . $data->{$key}->getClientOriginalExtension();
            $file_name = Auth::user()->id . '_' . $file_base;

//            Store file as random string file name
            $path = $data->{$key}->storeAs('supporting_docs', $file_name);

            //            Find existing document
            $document = Document::where('registration_id', '=', $registration->id)->where('file_type', '=', $file_type)->where('file_status', '=', 'active')->first();

//            If 'old' document exists, mark as inactive
            if($document) {
                $document->file_status = 'inactive';
                $document->save();
            }

//            Create new document based on uploaded file
            $document = Document::create([
                'registration_id'   => $registration->id,
                'file_path'         => $path,
                'file_type'         => $file_type,
                'file_status'       =>  'active',
            ]);
            
            array_push($documents, (object)[
                $file_type =>       $document->id
            ]);
        }
        $registration->documents = $documents;

        return $registration->save();
        return true;
    }
}
