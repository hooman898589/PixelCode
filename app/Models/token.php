<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class token extends Model
{
   protected $fillable=[
       'token',
       'user_id',
   ];

   public function useritem(){
       return $this->hasOne(User::class,'id','user_id')
           ->select('id','name');
   }
}
