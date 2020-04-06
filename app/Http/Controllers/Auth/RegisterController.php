<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\University;
use App\User;
use App\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'terms' => 'array',
    ];

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $counties = '[{"value":"","display":"Select Your County","disabled":true},{"value":"","display":"Northern Ireland","disabled":true},{"value":"Antrim","display":"Antrim","disabled":false},{"value":"Armagh","display":"Armagh","disabled":false},{"value":"Down","display":"Down","disabled":false},{"value":"Fermanagh","display":"Fermanagh","disabled":false},{"value":"Derry / Londonderry","display":"Derry / Londonderry","disabled":false},{"value":"Tyrone","display":"Tyrone","disabled":false},{"value":"","display":"England","disabled":true},{"value":"Bedfordshire","display":"Bedfordshire","disabled":false},{"value":"Buckinghamshire","display":"Buckinghamshire","disabled":false},{"value":"Cambridgeshire","display":"Cambridgeshire","disabled":false},{"value":"Cheshire","display":"Cheshire","disabled":false},{"value":"Cleveland","display":"Cleveland","disabled":false},{"value":"Cornwall","display":"Cornwall","disabled":false},{"value":"Cumbria","display":"Cumbria","disabled":false},{"value":"Derbyshire","display":"Derbyshire","disabled":false},{"value":"Devon","display":"Devon","disabled":false},{"value":"Dorset","display":"Dorset","disabled":false},{"value":"Durham","display":"Durham","disabled":false},{"value":"East Sussex","display":"East Sussex","disabled":false},{"value":"Essex","display":"Essex","disabled":false},{"value":"Gloucestershire","display":"Gloucestershire","disabled":false},{"value":"Greater London","display":"Greater London","disabled":false},{"value":"Greater Manchester","display":"Greater Manchester","disabled":false},{"value":"Hampshire","display":"Hampshire","disabled":false},{"value":"Hertfordshire","display":"Hertfordshire","disabled":false},{"value":"Kent","display":"Kent","disabled":false},{"value":"Lancashire","display":"Lancashire","disabled":false},{"value":"Leicestershire","display":"Leicestershire","disabled":false},{"value":"Lincolnshire","display":"Lincolnshire","disabled":false},{"value":"Merseyside","display":"Merseyside","disabled":false},{"value":"Norfolk","display":"Norfolk","disabled":false},{"value":"North Yorkshire","display":"North Yorkshire","disabled":false},{"value":"Northamptonshire","display":"Northamptonshire","disabled":false},{"value":"Northumberland","display":"Northumberland","disabled":false},{"value":"Nottinghamshire","display":"Nottinghamshire","disabled":false},{"value":"Oxfordshire","display":"Oxfordshire","disabled":false},{"value":"Shropshire","display":"Shropshire","disabled":false},{"value":"Somerset","display":"Somerset","disabled":false},{"value":"South Yorkshire","display":"South Yorkshire","disabled":false},{"value":"Staffordshire","display":"Staffordshire","disabled":false},{"value":"Suffolk","display":"Suffolk","disabled":false},{"value":"Surrey","display":"Surrey","disabled":false},{"value":"Tyne and Wear","display":"Tyne and Wear","disabled":false},{"value":"Warwickshire","display":"Warwickshire","disabled":false},{"value":"West Berkshire","display":"West Berkshire","disabled":false},{"value":"West Midlands","display":"West Midlands","disabled":false},{"value":"West Sussex","display":"West Sussex","disabled":false},{"value":"West Yorkshire","display":"West Yorkshire","disabled":false},{"value":"Wiltshire","display":"Wiltshire","disabled":false},{"value":"Worcestershire","display":"Worcestershire","disabled":false},{"value":"","display":"Wales","disabled":true},{"value":"Flintshire","display":"Flintshire","disabled":false},{"value":"Glamorgan","display":"Glamorgan","disabled":false},{"value":"Merionethshire","display":"Merionethshire","disabled":false},{"value":"Monmouthshire","display":"Monmouthshire","disabled":false},{"value":"Montgomeryshire","display":"Montgomeryshire","disabled":false},{"value":"Pembrokeshire","display":"Pembrokeshire","disabled":false},{"value":"Radnorshire","display":"Radnorshire","disabled":false},{"value":"Anglesey","display":"Anglesey","disabled":false},{"value":"Breconshire","display":"Breconshire","disabled":false},{"value":"Caernarvonshire","display":"Caernarvonshire","disabled":false},{"value":"Cardiganshire","display":"Cardiganshire","disabled":false},{"value":"Carmarthenshire","display":"Carmarthenshire","disabled":false},{"value":"Denbighshire","display":"Denbighshire","disabled":false},{"value":"","display":"Scotland","disabled":true},{"value":"Aberdeen City","display":"Aberdeen City","disabled":false},{"value":"Aberdeenshire","display":"Aberdeenshire","disabled":false},{"value":"Angus","display":"Angus","disabled":false},{"value":"Argyll and Bute","display":"Argyll and Bute","disabled":false},{"value":"City of Edinburgh","display":"City of Edinburgh","disabled":false},{"value":"Clackmannanshire","display":"Clackmannanshire","disabled":false},{"value":"Dumfries and Galloway","display":"Dumfries and Galloway","disabled":false},{"value":"Dundee City","display":"Dundee City","disabled":false},{"value":"East Ayrshire","display":"East Ayrshire","disabled":false},{"value":"East Dunbartonshire","display":"East Dunbartonshire","disabled":false},{"value":"East Lothian","display":"East Lothian","disabled":false},{"value":"East Renfrewshire","display":"East Renfrewshire","disabled":false},{"value":"Eilean Siar","display":"Eilean Siar","disabled":false},{"value":"Falkirk","display":"Falkirk","disabled":false},{"value":"Fife","display":"Fife","disabled":false},{"value":"Glasgow City","display":"Glasgow City","disabled":false},{"value":"Highland","display":"Highland","disabled":false},{"value":"Inverclyde","display":"Inverclyde","disabled":false},{"value":"Midlothian","display":"Midlothian","disabled":false},{"value":"Moray","display":"Moray","disabled":false},{"value":"North Ayrshire","display":"North Ayrshire","disabled":false},{"value":"North Lanarkshire","display":"North Lanarkshire","disabled":false},{"value":"Orkney Islands","display":"Orkney Islands","disabled":false},{"value":"Perth and Kinross","display":"Perth and Kinross","disabled":false},{"value":"Renfrewshire","display":"Renfrewshire","disabled":false},{"value":"Scottish Borders","display":"Scottish Borders","disabled":false},{"value":"Shetland Islands","display":"Shetland Islands","disabled":false},{"value":"South Ayrshire","display":"South Ayrshire","disabled":false},{"value":"South Lanarkshire","display":"South Lanarkshire","disabled":false},{"value":"Stirling","display":"Stirling","disabled":false},{"value":"West Dunbartonshire","display":"West Dunbartonshire","disabled":false},{"value":"West Lothian","display":"West Lothian","disabled":false}]';
        $universities = University::all();

        foreach ($universities as $university) {
            $university->display = $university->name;
            $university->value = $university->id;
            $university->disabled = false;
        }

        $university_placeholder = new University();
        $university_placeholder->display = 'Select Your University';
        $university_placeholder->value = '';
        $university_placeholder->disabled = true;


        $universities->prepend($university_placeholder);

        return view('auth.register', compact('counties', 'universities'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $request['date_of_birth'] = Carbon::createFromFormat('D M d Y H:i:s e+', $request['date_of_birth']);
        $request['entry_date'] = Carbon::createFromFormat('D M d Y H:i:s e+', $request['entry_date']);

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return 'success'; // return success message

//        return $this->registered($request, $user)
//            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $messages = [
            'postal_code'                                   => 'Enter a UK :attribute',
            'home_address_1.required'                       => ':attribute is required.',
            'required'                                      => ':attribute is required.',
            'entry_date.before'                             => 'The :attribute must be a date more than 4 years ago.',
            'entry_date.after'                              => 'The :attribute must be a date in the past 7 years.',
            '__previous_training__details.required_if'      => ':attribute is required when Previous Pre-Reg Training has been undertaken.',
            'accepted'                                      => 'You must agree to the above statement.'
        ];

        $attrs = [
            'title'                                         => 'Title',
            'forenames'                                     => 'Forename(s)',
            'surname'                                       => 'Surname',
            'email'                                         => 'Email',
            'date_of_birth'                                 => 'Date of Birth',

            'home_address_1'                                => 'Home Address Line 1',
            'home_address_2'                                => 'Home Address Line 2',
            'city'                                          => 'Town / City',
            'county'                                        => 'County',
            'postcode'                                      => 'Postcode',
            'country'                                       => 'Country',
            'phone_mobile'                                  => 'Mobile Phone',
            'phone_home'                                    => 'Home Phone',

            'university_id'                                 => 'University',
            'entry_date'                                    => 'Date of Entry to Degree Course',
            'previous_training'                             => 'Previous Pre-Reg Training',
            '__previous_training__details'                  => 'Details of Previous Training',

            'password'                                      => 'Password'
        ];

        return Validator::make($data, [
            'title'                                         => ['required', 'string', 'max:4'],
            'forenames'                                     => ['required', 'string', 'max:255'],
            'surname'                                       => ['required', 'string', 'max:255'],
            'email'                                         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date_of_birth'                                 => ['required', 'date', 'before:-18 years'],
            'password'                                      => ['required', 'string', 'min:8', 'confirmed'],

            'home_address_1'                                => ['required', 'string', 'max:255'],
            'city'                                          => ['required', 'string', 'max:255'],
            'county'                                        => ['required', 'string', 'max:255'],
            'postcode'                                      => ['required', 'postal_code:GB', 'string', 'max:255'],
            'phone_mobile'                                  => ['required', 'phone:GB,mobile'],
            'phone_home'                                    => ['sometimes', 'nullable', 'phone:GB'],

            'university_id'                                 => ['required', 'numeric'],
            'entry_date'                                    => ['required', 'date', 'before:-4 years', 'after:-7 years'],
            '__previous_training__details'                  => ['required_if:previous_training,yes'],

            'declaration_1'                                 => ['accepted'],
            'declaration_2'                                 => ['accepted'],
            'declaration_3'                                 => ['accepted'],
            'declaration_4'                                 => ['accepted'],
            'declaration_5'                                 => ['accepted'],

        ], $messages, $attrs);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $student = Student::create([
            'user_id'                       => $user->id,
            'title'                         => $data['title'],
            'forenames'                     => $data['forenames'],
            'surname'                       => $data['surname'],
            'known_as'                      => $data['known_as'],
            'previous_name'                 => $data['previous_name'],
            'home_address_1'                => $data['home_address_1'],
            'home_address_2'                => $data['home_address_2'],
            'city'                          => $data['city'],
            'county'                        => $data['county'],
            'postcode'                      => $data['postcode'],
            'phone_mobile'                  => $data['phone_mobile'],
            'phone_home'                    => $data['phone_home'],
            'date_of_birth'                 => Carbon::parse($data['date_of_birth']),
            'university_id'                 => $data['university_id'],
            'entry_date'                    => Carbon::parse($data['entry_date']),
            'previous_training'             => boolval($data['previous_training']),
            'previous_training_details'     => $data['__previous_training__details'],
            'terms'                         => json_encode([
                'declaration_1'             => $data['declaration_1'],
                'declaration_2'             => $data['declaration_2'],
                'declaration_3'             => $data['declaration_3'],
                'declaration_4'             => $data['declaration_4'],
                'declaration_5'             => $data['declaration_5'],
            ]),
        ]);

        $user->setStatus('payment_required');

        return $user;
    }
}
