<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends BaseController
{
    protected $module = 'review';

    protected $storeRules = [
        'scores.*' => 'required|numeric',
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

        return redirect()->route('marker.list-design')->withSuccess(Auth::user()->name . '评分成功');
    }

    public function teaching(Request $request)
    {
        $this->validate($request, $this->storeRules);

        $data = [
            'year' => date('Y'),
            'marker_id' => Auth::id(),
        ];

        foreach ($request->input('scores') as $id => $score) {
            $data['player_id'] = $id;
            $data['live_score'] = $score;
            
            $this->service->store($data);
        }

        return redirect()->route('marker.list-teaching')->withSuccess(Auth::user()->name . '评分成功');
    }
}
