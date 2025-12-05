<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class addinproject extends Model
{
    protected $fillable =[
        'project_id',
        'user_id',
        'owner_id',
    ];

    public function useritems(){
        return $this->hasOne(User::class, 'id', 'user_id')->select('id', 'name');
    }

    public function owneritems(){
        return $this->hasOne(User::class, 'id', 'owner_id')->select('id', 'name');
    }

    public function repoitems(){
        return $this->hasOne(Repo::class, 'id', 'project_id')->select('id', 'slug','repo');
    }
}
