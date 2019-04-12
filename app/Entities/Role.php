<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function users()
    {
        return $this->hasMany('App\Entities\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Entities\Permission', 'role_permission')->withTimestamps();
    }
}
