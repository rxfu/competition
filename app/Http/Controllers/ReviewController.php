<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;

class ReviewController extends BaseController
{
    protected $module = 'review';

    protected $storeRules = [
        'name' => 'required',
    ];

    public function __construct(ReviewService $reviewService)
    {
        $this->service = $reviewService;

        $this->updateRules = $this->storeRules;
    }
}
