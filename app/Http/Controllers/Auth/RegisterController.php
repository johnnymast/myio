<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\EmailVerification;
use App\Role;
use App\Session\Flash;
use App\User;
use DB;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(16),
        ]);

        // Add role
        $role = Role::whereName('User')->first();

        $user->assignRole($role);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // A number of things are happening here so we are enclosing in transaction
        // In case anything goes wrong in the process
        DB::beginTransaction();

        try {
            $user = $this->create($request->all());
            event(new Registered($user));

            // Send verification email
            $user->notify(new EmailVerification($user));

            Flash::success('Signup successful. Please check your email for activation instructions');
            DB::commit();

            return redirect()->to('/');
        } catch (Exception $e) {
            dd($e->getMessage());

            DB::rollback();

            return back();
        }
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    public function verify($token)
    {
        User::where('email_token', $token)->firstOrFail()->verified();

        Flash::success('Activation successful!');

        return redirect('login');
    }
}
