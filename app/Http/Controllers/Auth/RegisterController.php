<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\front\RegisterRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;



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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:255'],
            'birthdate' => ['nullable','integer'],
            'photo' => ['required_without:id,mimes:jpg,jpeg,png', 'max:255'],

        ]);
    }
*/
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(RegisterRequest $data)
    {
        //return gettype($data->birth_date);
        try{

            if($data->gender == 1){
                $photoPath='images/users/default-user-female-logo.png';
            }else{
                $photoPath='images/users/default-user-male-logo.png';
            }
            
            if($data->has('photo'))
            $photoPath=uploadFile($data->photo,'images/users');
        
            $user=User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password),
                'photo' => $photoPath,
                'birth_date' => $data->birth_date,
                'gender' => $data->gender,
                'interest' => $data->interest,
                'description' => $data->description,
            ]);
            event(new Registered($user));
            Auth::login($user);

            return redirect()-> route('verification.notice')->with([
                'notifyBtn' => 'btn-successToast','notifyTitle' => 'التسجيل في الموقع','notifyMsg' => 'مرحبا تم التسجيل في الموقع بنجاح'
            ]);
            
        }catch (\Exception $ex){
            return redirect()-> route('Course.index')
            ->with([
                'notifyBtn' => 'btn-dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل التسجيل في الموقع لسبب ما يرجى إعادة المحاولة  '
            ]);
        }
    }
}
