<?php

namespace App\Services;

use App\Repositories\ReviewRepository;

class ReviewService extends Service
{
    public function __construct(ReviewRepository $reviews)
    {
        $this->repository = $reviews;
    }
}
