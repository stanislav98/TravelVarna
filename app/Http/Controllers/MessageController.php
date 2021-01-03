<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\TwiML\MessagingResponse;
use DB;
use LaravelQRCode\Facades\QRCode;
use App\Models\User;

class MessageController extends Controller
{
    //
    public function handleMessage(Request $request){
    	// here we generate a qr_code
    	$from_phone = str_replace('+359','0',$request->From);
    	if($request->Body == 'QR_ACTIVATE') {
	    	$user = User::where('phone',$from_phone)->first();
	    	if(!empty($user)) {
		    	if($user->qr_active == 0) {
			 		 DB::table('users')
			            ->where('id',$user->id)
			            ->update(['qr_active' => 1,'qrcode_path' => 'uploads/users_qr_codes/'.$user->id.'.png']);
			       	
			        QRCode::text('One way ticket')->setSize(10)->setMargin(2)->setOutfile('uploads/users_qr_codes/'.$user->id.'.png')->png();
					$response = new MessagingResponse();
					$response->message("Thank you your QR-Code has been applied!");
					print $response;
		    	} else {
		    		$response = new MessagingResponse();
					$response->message("You already have an QR-Code applied!");
					print $response;
		    	}
		    } else {
		    	$response = new MessagingResponse();
				$response->message("We couldn't find your phone number!Please check your phone number in options!");
				print $response;
		    }
	    } 
    }
}
