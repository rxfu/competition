<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\Entities\User');
    }

    public function markers()
    {
        return $this->hasMany('App\Entities\User')->whereRoleId(config('setting.marker'))->orderBy('id');
    }
}
