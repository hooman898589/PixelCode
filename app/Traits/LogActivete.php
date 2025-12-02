<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

trait LogActivete
{
    public function logActivete($action,$model ){
        $faaction=$this->persianaction($action);
        $famodel=$this->persianmodel($model);
        $fatitle=$this->gettitle($model);

        $name=Auth::user()->name;

        $id=Auth::id();


//        $massage='مدل یوزر ایجاد شد نام : سلام توسط : کاربر';
//        $massagelog =  " $fatitle با خونه   $famodel و مدل  $id با ایدی $email با ایمیل :  $name :توسط:  ";
        $modellog=" مدلی از رکورد ".$famodel.' '.$faaction.'  شد ';
        $mainfild=' با خونه برتر : '.$fatitle.' ';
        $userlog='توسط کاربری با نام : '.$name;

        $logid=' و شماره خونه کاربری :  '.$id;
        date_default_timezone_set('Asia/Tehran');
        $datetime = date('Y-m-d H:i:s');
        $massagelog=" [$datetime] ".$modellog.$mainfild.$userlog.$logid;

         Log::record(class_basename($model) , $model->id,$massagelog ,$action ,$id );



    }
    public function persianmodel($model)
    {
        $base=class_basename($model);
        return match (class_basename($base)) {
            'repo' => 'ریپازیتوری ها',
            'branch'=>'شاخه',
            'task'=>'کارها',
            'blacklist'=>'لیست سیاه پوست',
            'bug'=>'باگ ها',
            'User'=>'کاربر ها',
            default =>$base,

        };
    }
    public function persianaction($action)
    {
        return match ($action){
          'create'=>'ایجاد',
           'update'=>'بروزرسانی',
           'delete'=>'حذف',
           'login'=>'ورود' ,
            default =>$action,
        };

    }
    public function gettitle($model){
        return match (true) {
            isset($model->title) => ' عنوان: ' . $model->title." و شماره خونه : ".$model->id,
            isset($model->name)=>' نام: ' . $model->name." و شماره خونه :  ".$model->id,
            isset($model->repo)=>' ریپازیتوری: ' . $model->repo." و شماره خونه : ".$model->id,
            isset($model->branch)=>' شاخه: '.$model->branch." و شماره خونه : ".$model->id,

            default =>" ایدی  ".$model->id,
        };
    }


}
