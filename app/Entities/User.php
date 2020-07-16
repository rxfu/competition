<?php

namespace App\Entities;

use Auth;
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
        'username', 'password', 'name', 'email', 'is_enable', 'is_super', 'birthday', 'idnumber', 'gender_id', 'education_id', 'degree_id', 'department_id', 'subject_id', 'major', 'direction', 'position', 'phone', 'address', 'leader', 'leader_phone', 'group_id', 'course', 'teaching_begin_time', 'portrait', 'creator_id', 'role_id', 'is_passed', 'is_confirmed', 'memo', 'idtype', 'teaching_total_time', 'experience', 'teaching', 'thesis', 'project', 'reward', 'achievement', 'opinion', 'title', 'recommend', 'summary',
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
        'is_passed' => 'boolean',
        'is_confirmed' => 'boolean',
    ];

    protected $appends = ['total', 'design', 'live'];

    protected $presenter = 'App\Presenters\UserPresenter';

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function role()
    {
        return $this->belongsTo('App\Entities\Role');
    }

    public function department()
    {
        return $this->belongsTo('App\Entities\Department');
    }

    public function subject()
    {
        return $this->belongsTo('App\Entities\Subject');
    }

    public function education()
    {
        return $this->belongsTo('App\Entities\Education');
    }

    public function degree()
    {
        return $this->belongsTo('App\Entities\Degree');
    }

    public function gender()
    {
        return $this->belongsTo('App\Entities\Gender');
    }

    public function creator()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Entities\Group');
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

    public function review()
    {
        return $this->hasOne('App\Entities\Review', 'player_id')->whereMarkerId(Auth::id());
    }

    // public function getTotalAttribute()
    // {
    //     $items = Review::wherePlayerId($this->id)->get();

    //     if ($items->count() === 0) {
    //         $total = 0;
    //     } else {
    // 先计总分，后去掉最高分、最低分，最后求平均
    /* 
            $scores = [];
            foreach ($items as $item) {
                $scores[] = $item->design_score + $item->live_score + $item->reflection_score;
            }

            if ($items->count() > 2) {
                sort($scores);
                array_pop($scores);
                array_shift($scores);
            }

            $total = array_sum($scores) / count($scores);
            */
    /* 
            教学设计分：去掉最高分、最低分，求平均；
            现场分：课堂教学分 + 反思分，总分去掉最高分、最低分，求平均；
            最终分 = 教学设计份 + 现场分。
             */
    /*
            $designScores = [];
            $liveScores = [];
            foreach ($items as $item) {
                $designScores[] = $item->design_score;
                $liveScores[] = $item->live_score + $item->reflection_score;
            }

            if ($items->count() > 2) {
                sort($designScores);
                array_pop($designScores);
                array_shift($designScores);

                sort($liveScores);
                array_pop($liveScores);
                array_shift($liveScores);
            }

            $total = array_sum($designScores) / count($designScores) + array_sum($liveScores) / count($liveScores);
            */
    //         $total = $this->design + $this->live;
    //     }

    //     return $total;
    // }
    /**
     * 最终分 = 教学设计分 + 现场分
     */
    public function getTotalAttribute()
    {
        return $this->design + $this->live;
    }

    /**
     * 教学设计分：去掉最高分、最低分，求平均
     */
    public function getDesignAttribute()
    {
        $items = Review::wherePlayerId($this->id)->get();

        if ($items->count() === 0) {
            $score = 0;
        } else {
            $scores = $items->pluck('design_score')->toArray();

            if ($items->count() > 2) {
                sort($scores);
                array_pop($scores);
                array_shift($scores);
            }

            $score = array_sum($scores) / count($scores);
        }

        return $score;
    }

    /**
     * 现场分：课堂教学分 + 反思分，总分去掉最高分、最低分，求平均
     */
    public function getLiveAttribute()
    {
        $items = Review::wherePlayerId($this->id)->get();

        if ($items->count() === 0) {
            $score = 0;
        } else {
            $scores = $items->pluck('live')->toArray();

            if ($items->count() > 2) {
                sort($scores);
                array_pop($scores);
                array_shift($scores);
            }

            $score = array_sum($scores) / count($scores);
        }

        return $score;
    }
}
