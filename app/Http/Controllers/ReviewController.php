<?php

namespace App\Http\Controllers;

use App\Entities\Document;
use App\Entities\User;
use App\Services\ReviewService;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends BaseController
{
    protected $module = 'review';

    protected $storeRules = [
        'scores.*' => 'required|numeric|min:0|max:20',
    ];

    public function __construct(ReviewService $reviewService)
    {
        $this->service = $reviewService;

        $this->updateRules = $this->storeRules;
    }

    public function design(Request $request)
    {
        $this->validate($request, $this->storeRules);

        $data = [
            'year' => date('Y'),
            'marker_id' => Auth::id(),
        ];

        foreach ($request->input('scores') as $id => $score) {
            $data['player_id'] = $id;
            $data['design_score'] = $score;
            
            $this->service->store($data);
        }

        return redirect()->route('marker.design')->withSuccess(Auth::user()->name . '评分成功');
    }

    public function teaching(Request $request, $id)
    {
        $this->validate($request, [
            'score' => 'required|numeric|min:0|max:80',
        ]);

        $next = null;
        $data = [
            'year' => date('Y'),
            'marker_id' => Auth::id(),
        ];

        $exists = User::whereGroupId(Auth::user()->group_id)
                        ->whereRoleId(config('setting.player'))
                        ->whereId($id)
                        ->exists();

        if ($exists) {
            $data['player_id'] = $id;
            $data['live_score'] = $request->input('score');
            
            $this->service->store($data);

            $player = Document::whereHas('user', function ($query) {
                        $query->whereGroupId(Auth::user()->group_id)
                            ->whereRoleId(config('setting.player'))
                            ->whereHas('playerReviews', function ($q) {
                                $q->where('year', '=', date('Y'))->whereMarkerId(Auth::id())->whereNull('live_score');
                            });
            })
                    ->where('year', '=', date('Y'))
                    ->whereNotNull('seq')
                    ->orderBy('seq')
                    ->first(['user_id', 'seq']);

            if ($player) {
                return redirect()->route('marker.teaching', $player->user_id)->withSuccess(Auth::user()->name . '评分成功，开始第' . $player->seq . '号选手评分');
            } else {
                return redirect()->route('marker.teaching')->withSuccess(Auth::user()->name . '评分成功，所有选手已评分完毕');
            }
        }
    }
}
