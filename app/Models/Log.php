<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable=[
        'user_id',
        'model_id',
        'type_model',
        'description',
        'action',
        ];

    public static function record($type_model,$model_id,$description,$action,$user_id){

        self::create([
            'user_id'=>$user_id,
            'model_id'=>$model_id,
            'type_model'=>$type_model,
            'description'=>$description,
            'action'=>$action,

        ]);
        try {


            if (!file_exists(public_path('log.txt'))) {
                file_put_contents(public_path('log.txt'), "========این همه لاگ های این سایت است ==========\n");

            }
            file_put_contents(public_path('log.txt'), "\n $description", FILE_APPEND | LOCK_EX);
        }catch (\Exception $e){
            Log::error('خطا در نوشتن لاگ فایل: ' . $e->getMessage());
        }
    }
}
