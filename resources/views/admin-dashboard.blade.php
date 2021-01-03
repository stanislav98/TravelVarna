<?php
use Illuminate\Support\Facades\Auth; 
    $user = Auth::user();
	if($user->type_id != 7 ) {
        return view('admin-dashboard',['title' => 'Администрация']);
    } else {
        return view('/');
    }
?>