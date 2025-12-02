<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    use Sluggable;
    protected $fillable=['repo_id','name','sha', 'slug'];



    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',

                'separator' => '-',
        'unique' => true,
            ]
        ];
    }

}
