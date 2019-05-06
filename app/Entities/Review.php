<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Review extends Model
{
    use PresentableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year', 'marker_id', 'player_id', 'design_score', 'live_score', 'reflection_score', 'design_confirmed',
    ];

    protected $presenter = 'App\Presenters\ReviewPresenter';

    public function marker()
    {
        return $this->belongsTo('App\Entities\User', 'marker_id');
    }

    public function player()
    {
        return $this->belongsTo('App\Entities\User', 'player_id');
    }
}
