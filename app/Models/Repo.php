<?php

namespace App\Models;

use App\Http\Controllers\git\RepoSettingController;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Repo extends Model
{
    use Sluggable;
    protected $fillable=['id','repo','username', 'user_id','slug'];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'repo_id', 'id')
            ->select('branches.id', 'branches.repo_id', 'branches.name', 'branches.slug', 'branches.sha');

    }



    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'repo',
                'separator' => '-',
        'unique' => true,
            ]
        ];
    }


    public function additems()
    {
        return $this->hasOne(addinproject::class, 'project_id', 'id')->select('id');
    }
}
