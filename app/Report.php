<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'user_id','user_name','phone','email', 'penalty_id', 'violation', 'violation_image_path'
     ];
}