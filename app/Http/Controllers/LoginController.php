<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialFacebookAccountService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;



class LoginController extends Controller
{
     public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect('/');
    }

      public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect('/');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
    
            $user = Socialite::driver('facebook')->stateless()->user();

            $finduser = User::where('facebook_id', $user->id)->first();
     
            if($finduser){
                if($finduser->active_profile == 1) {
                    Auth::loginUsingId($finduser->id);
                    return redirect('/');
                } else {
                     return redirect('/')->withErrors(['Първо трябва да активирате профила си']);
                }
    
     
            }else{
               $hashed_random_password = Hash::make(Str::random(8));
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => $hashed_random_password,
                    'phone' => "0",
                    'type_id' => "1",
                    'active_profile' => 1,
                ]);
    
                Auth::login($newUser);
     
               return redirect('/');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    } 

    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                $to_email = $finduser->email;
        
                if($finduser->active_profile == 1) {
                    Auth::loginUsingId($finduser->id);
                    return redirect('/');
                } else {
                    $html ='';
                    $styles = 'style="background: green;
                        color: #fff;
                        font-size: 16px;
                        padding: 5px 15px;
                        border-radius: 20px;
                        text-underline-offset: none;
                        text-decoration: none;"';
                    $url = 'https://travelvarna.obufki.eu/activate/'.$finduser->id;
                    $html .= '<h2>Натиснете бутона за да активирате профила си отново</h2>';
                    $html .= '<a href="'.$url.'" '.$styles.'>Активирай</a>';

                      Mail::send(array(),['html' => $html,'to_email' => $to_email], function ($message) use ($html,$to_email) {
                          $message->to($to_email, 'Travel Varna Website')
                            ->subject('Activate Profile - Travel Varna Website')
                            ->from('travelvarna@travelvarna.obufki.eu','Travel Varna Website')
                            ->setBody($html, 'text/html');
                        });
                     return Redirect::back()->withErrors(['Първо трябва да активирате профила си','Имейл беше изпратен на '.$to_email]);
                }
     
            }else{
               $hashed_random_password = Hash::make(Str::random(8));
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => $hashed_random_password,
                    'phone' => "0",
                    'type_id' => "1",
                    'active_profile' => 1,
                ]);
    
                 Auth::login($newUser);
     
               return redirect('/');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

   public function defaultAuthenticate(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
          if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active_profile' => 1])) {
                return redirect('/');
          } else {
            Auth::logout();
               return redirect('/')->withErrors(['Първо трябва да активирате профила си']);
          }
        } else {
             return redirect('/')->withErrors(['Първо трябва да активирате профила си']);
            // return redirect('/');
        }
    }
}
