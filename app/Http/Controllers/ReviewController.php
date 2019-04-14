<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends BaseController
{
    protected $module = 'review';

    protected $storeRules = [
        'design_score' => 'numeric',
        'live_score' => 'numeric',
    ];

    public function __construct(ReviewService $reviewService)
    {
        $this->service = $reviewService;

        $this->updateRules = $this->storeRules;
    }

    public function store(Request $request)
    {
        $request->offsetSet('year', date('Y'));
        $request->offsetSet('marker_id', Auth::id());

        $this->validate($request, $this->storeRules);

        $this->service->store($request->all());

        return redirect()->route('marker.list-design')->withSuccess('评分成功');
    }
}
