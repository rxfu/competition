<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Department extends Model
{
    use PresentableTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'is_enable',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_enable' => 'boolean',
    ];

    protected $presenter = 'App\Presenters\DepartmentPresenter';

    public function users()
    {
        return $this->hasMany('App\Entities\User');
    }
}
