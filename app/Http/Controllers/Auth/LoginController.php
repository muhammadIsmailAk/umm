<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;                

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    //  public function redirectTo() {
    //     $role = Auth::user()->role; 
    //     switch ($role) {
    //       case 'admin':
    //         return '/admin';
    //         break;
    //       case 'supervisor':
    //         return '/homes';
    //         break; 
    //         case 'faculty':
    //             return '/homef';
    //             break; 
      
    //             case 'student':
    //                 return '/homeu';
    //                 break; 
              
      
    //       default:
    //         return '/homeu'; 
    //       break;
    //     }
    //   }
      
      public function logout(Request $request) {
        Session::flush();
        
        
        Auth::logout();
       
       return redirect()->route('login');
      }




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin');
            }else if (auth()->user()->role == 'faculty') {
                return redirect()->route('homef');
            }else if (auth()->user()->role == 'supervisor') {
                return redirect()->route('homes');
            }
            else if (auth()->user()->role == 'student') {
                return redirect()->route('homeu');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }



    public function handleGoogleCallback()
{
    $user = Socialite::driver('google')->user();
echo $user;
die;

    // Check if the user already exists in your database based on their email address
    $existingUser = User::where('email', $user->email)->first();

    if ($existingUser) {
        // Log in the existing user
        Auth::login($existingUser, true);
        echo 'cdfd';
die;
        
        return redirect()->route('homeu');
    } 
    // else {
    //     // Create a new user record and log them in
    //     $newUser = new User();
    //     $newUser->name = $user->name;
    //     $newUser->email = $user->email;
    //     $newUser->password = bcrypt(str_random(16)); // Generate a random password
    //     $newUser->save();

    //     Auth::login($newUser, true);
    // }

    // Redirect the user to the desired page
    return redirect('/login');
}

public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}
}
