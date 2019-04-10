<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laracasts\Presenter\PresentableTrait;

class User extends Authenticatable
{
    use Notifiable;
    use PresentableTrait;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'name', 'email', 'is_enable', 'is_super', 'birthday', 'idnumber', 'gender_id', 'education_id', 'degree_id', 'department_id', 'subject_id', 'major', 'direction', 'position', 'phone', 'address', 'leader', 'leader_phone', 'group_id', 'course', 'teaching_begin_time', 'portrait', 'creator_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_enable' => 'boolean',
        'is_super' => 'boolean',
    ];

    protected $presenter = 'App\Presenters\UserPresenter';

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Entities\Role');
    }

    public function departments()
    {
        return $this->belongsToMany('App\Entities\Department', 'user_department')->withTimestamps();
    }

    public function logs()
    {
        return $this->hasMany('App\Entities\Log');
    }

    public function document()
    {
        return $this->hasOne('App\Entities\Document');
    }

    public function markerReviews()
    {
        return $this->hasMany('App\Entities\Review', 'marker_id');
    }

    public function playerReviews()
    {
        return $this->hasMany('App\Entities\Review', 'player_id');
    }
}
