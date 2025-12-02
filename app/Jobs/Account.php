<?php

namespace App\Jobs;

use App\Mail\Newpassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Account implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $token;
    public $user;
    public function __construct($token,$user)
    {
        $this->token=$token;
        $this->user=$user;
    }

    /**
     * Execute the job.
     */
    public function handle(){

        Mail::to($this->user->email)->send(new Newpassword($this->token, $this->user));
    }
}
