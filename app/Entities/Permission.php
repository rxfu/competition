<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'description',
    ];
    
    public function roles()
    {
        return $this->belongsToMany('App\Entities\Role', 'role_permission')->withTimestamps();
    }
}
