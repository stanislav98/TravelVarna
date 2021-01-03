<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Session;

class OptionsController extends Controller
{
	public function create()
	{
	 return view('options',['title' => 'Настройки']);
	}

    public function update(Request $request)
    {
    	  $request->validate([
             'change_name'           => ['required','regex:/^[\pL\s\-]+$/u'],
             'change_phone'           => ['required', 'numeric','digits:10'],
             'change_email'           => ['required', 'string', 'email', 'max:255'],
         ]);
    	    if($request->change_subscription != NULL) {
    	  	DB::table('users')
	            ->where('id', $request->user_id)
	            ->update(['notify_change_subscription' => 1]);
	            $to_email = DB::table('users')->where('id', $request->user_id)->get()->first();
	            $to_email = $to_email->email;
	               $html ='';
                    $styles = 'style="background: green;
                        color: #fff;
                        font-size: 16px;
                        padding: 5px 15px;
                        border-radius: 20px;
                        text-underline-offset: none;
                        text-decoration: none;"';
                    $url = 'https://travelvarna.obufki.eu';
                    $html .= '<h2>Благодарим ви че пожелахте да получавате известия при смяна на абонамента!</h2>';
                    $html .= '<a href="'.$url.'" '.$styles.'>Назад към сайта</a>';

                      Mail::send(array(),['html' => $html,'to_email' => $to_email], function ($message) use ($html,$to_email) {
                          $message->to($to_email, 'Travel Varna Website')
                            ->subject('Notify For Changes In Subscription - Travel Varna Website')
                            ->from('travelvarna@travelvarna.obufki.eu','Travel Varna Website')
                            ->setBody($html, 'text/html');
                        });
    	   } else {
    	   		DB::table('users')
	            ->where('id', $request->user_id)
	            ->update(['notify_change_subscription' => 0]);
    	   }

    	     if($request->new_penalty != NULL) {
    	  	DB::table('users')
	            ->where('id', $request->user_id)
	            ->update(['notify_tickets' => 1]);
	            $to_email = DB::table('users')->where('id', $request->user_id)->get()->first();
	            $to_email = $to_email->email;
	               $html ='';
                    $styles = 'style="background: green;
                        color: #fff;
                        font-size: 16px;
                        padding: 5px 15px;
                        border-radius: 20px;
                        text-underline-offset: none;
                        text-decoration: none;"';
                    $url = 'https://travelvarna.obufki.eu';
                    $html .= '<h2>Благодарим ви че пожелахте да получавате известия при нови направени фишове!</h2>';
                    $html .= '<a href="'.$url.'" '.$styles.'>Назад към сайта</a>';

                      Mail::send(array(),['html' => $html,'to_email' => $to_email], function ($message) use ($html,$to_email) {
                          $message->to($to_email, 'Travel Varna Website')
                            ->subject('Notify For New Penalties - Travel Varna Website')
                            ->from('travelvarna@travelvarna.obufki.eu','Travel Varna Website')
                            ->setBody($html, 'text/html');
                        });
    	   } else {
    	   		DB::table('users')
	            ->where('id', $request->user_id)
	            ->update(['notify_tickets' => 0]);
    	   }

    	  if($request->change_phone != NULL) {
    	  	DB::table('users')
	            ->where('id', $request->user_id)
	            ->update(['phone' => $request->change_phone]);
    	  } 
    	  if($request->change_name != NULL) {
    	  	DB::table('users')
	            ->where('id', $request->user_id)
	            ->update(['name' => $request->change_name]);
    	  }
    	  if($request->change_image != NULL) {
	     	$path = $request->change_image->store('report');
	          $file = $request->file('change_image');
	          $extension = $file->getClientOriginalExtension(); // getting image extension
	          $filename =$request->user_id.'-'.time().'.'.$extension;
	          $file->move('uploads/user_profiles/', $filename);
	          DB::table('users')
	            ->where('id', $request->user_id)
	            ->update(['profile_photo_path' => "uploads/user_profiles/".$filename]);
	        }
            if($request->delete_acc == 'delete') {
            	  DB::table('users')
    	            ->where('id', $request->user_id)->delete();
	             Auth::logout();
                 Session::flush();
                 return redirect('/');
            }
            if($request->deactivate_acc == 'deactivate') {
            	    DB::table('users')
	            ->where('id', $request->user_id)
	            ->update(['active_profile' => 0]);
                 Auth::logout();
                 Session::flush();
                 return redirect('/');
            }
    	   return redirect()->to('/options'); 
    }
}
