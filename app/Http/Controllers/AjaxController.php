<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;
class AjaxController extends Controller
{
    //
    public function contact(Request $request)
     {  
        
        $request->validate([
             'username'           =>  ['required','regex:/^[\pL\s\-]+$/u'],
             'phone'           => ['required', 'numeric','digits:10'],
             'email'           => ['required', 'string', 'email', 'max:255'],
             'message'  => 'required',
              'g-recaptcha-response' => 'required|captcha',
         ]);

         $html = '<h2>От : '.$request->username.'</h2>
         <p>Телефонен номер : '.$request->phone.'</p>
         <p>Съобщение : '.$request->message.'</p>
         ';

	      Mail::send(array(), array(), function ($message) use ($html) {
			  $message->to('staskata1998@gmail.com', 'Travel Varna Website')
			    ->subject('Contact Form - Travel Varna Website')
			    ->from('travelvarna@travelvarna.obufki.eu','Travel Varna Website')
			    ->setBody($html, 'text/html');
			});

	     return response()->json([ 'success'=> 'Вашето съобщение беше изпратено успешно!']);

	 }

	  public function subscriptionActivate(Request $request)
     {  
     	$timestamp = date("Y-m-d H:i:s");
        DB::table('table_all_subscriptions')->insert(
            array(
                'user_id'          => $request->input('user_id'),
                'subscription_date'           =>  $timestamp ,
                'subscription_id'           => $request->input('type_id'),
            )
        );
         DB::table('users')
			            ->where('id', $request->input('user_id'))
			            ->update(['subscription' => 1,'subscription_type' => $request->input('type_id')]);

         return response()->json([ 'success'=> 'Вие активирахте успешно абонамента си!']);

	 }

      public function deletePenalty(Request $request)
     {  
          DB::table('all_penalties')->where('id', $request->input('penalty_id'))->delete();
          return response()->json([ 'success'=> 'Вие успешно изтрихте репорта!']);
     }

      public function deletePost(Request $request)
     {  
          DB::table('posts')->where('id', $request->input('post_id'))->delete();
          return response()->json([ 'success'=> 'Вие успешно изтрихте репорта!']);
     }

      public function acceptPenalty(Request $request)
     {  
        $timestamp = date("Y-m-d H:i:s");
          DB::table('all_penalties')->where('id', $request->input('penalty_id'))->update([
            'penalty_active' => 1,
            'penalty_for_user' =>  $request->input('user_id') ,
            'penalty_date' => $timestamp,
          ]);
          return response()->json([ 'success'=> 'Вие успешно одобрихте репорта!']);
     } 

     public function addPosts(Request $request)
     {  
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->input('title'))));
        $timestamp = date("Y-m-d H:i:s");
           DB::table('posts')->insert(
            array(
                'title'          => $request->input('title'),
                'content'           => $request->input('content'),
                'slug'           => $slug,
                'created_at'           => $timestamp,
                'updated_at' => $timestamp,
            )
        );

     return response()->json([ 'success'=> 'Успешно добавихте публикация!']);
     }

     public function filterscheludes(Request $request) {
       $name = $request->input('stop_id');
       $result = DB::table('stops')->where('stop_name', 'like', '%' .$name . '%')->get()->first();
       return response()->json([ 'result'=> $result]);
     }

      public function encourage(Request $request)
     {  
            $value = session()->get('voted', 'default');
          if($value == 'default') {
               DB::table('all_ratings')->insert(
                    array(
                        'user_id'          => $request->input('user_id'),
                        'message'           => $request->input('message'),
                        'rating'           => $request->input('stars'),
                    )
                );
          $request->session()->put('voted', 'true');
         return response()->json([ 'success'=> 'Успешно поощрихте служителя!']);
        } else {
               return response()->json([ 'success'=> 'Вие гласувахте моля върнете се по-късно за да гласувате отново!']);
        }
     }
}
