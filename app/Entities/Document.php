<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year', 'user_id', 'syllabus', 'design', 'section', 'catalog', 'seq',
    ];

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }
}
