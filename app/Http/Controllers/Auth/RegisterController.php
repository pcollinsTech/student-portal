<?php

namespace App\Http\Controllers\Auth;

use App\DataLogic\Applications;
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
use Auth;

class RegisterController extends Controller
{

    /* Applications Logic */
    protected $applications;

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
    public function __construct(Applications $applications)
    {
        $this->middleware('auth')->only('profile');
        $this->applications = $applications;
    }


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */

    public function application()
    {
        $step = request()->get('step');
        return $this->applications->process($step);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('application.start');
    }



    /**
     * startRegister
     * Displays the registration form for the application.
     *
     */
    public function startRegister()
    {
        return view('application.start');
    }


    /**
     * profile
     * Displays the profie page .
     *
     */
    public function profile()
    {

        $user =  User::with(['Payments', 'Student', 'Student.pharmacies', 'Student.pharmacists', 'Student.registration',  'Student.registration.documents'])->find(auth()->user()->id);

        return view('profile')->with('user', $user);
    }

    public function test()
    {
        $user = Student::find(80);

        dd($user);
    }
}
