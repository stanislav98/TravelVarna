<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use DB;

class ReportController extends Controller
{
    public function create()
      {
         return view('report',['title' => 'Докладване']);
      }

     public function report(Request $request)
     {  
         $request->validate([
             'user_id'           => 'required',
             'user_name'           => ['required','regex:/^[\pL\s\-]+$/u'],
             'phone'           => ['required', 'numeric','digits:10'],
             'email'           => ['required', 'string', 'email', 'max:255'],
             'penalty_id'          => 'required',
             'violation'  => 'required',
             'violation_image_path'  => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
              'g-recaptcha-response' => 'required|captcha',
         ]);

         $path = $request->violation_image_path->store('report');
          $file = $request->file('violation_image_path');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =$request->user_id.'-'.time().'.'.$extension;
          $file->move('uploads/reports/', $filename);

        $penalty = DB::table('penalties')->where('penalty_id',$request->penalty_id)->get()->first();

        DB::table('all_penalties')->insert(
            array(
                'user_id'          => $request->user_id,
                'user_name'           => $request->user_name,
                'phone'           => $request->phone,
                'email'           => $request->email,
                'penalty_id'         => $request->penalty_id,
                'penalty_active'    => 0,
                'amount'       => $penalty->price,
                'violation' => $request->violation,
                'violation_image_path'       => $filename,
            )
        );

        return response()->json([ 'success'=> 'Вашето докладване беше изпратено успешно!']);

    }
}
