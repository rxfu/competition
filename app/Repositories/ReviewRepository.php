<?php

namespace App\Repositories;

use App\Entities\Review;

class ReviewRepository extends Repository
{
    public function __construct(Review $review)
    {
        $this->object = $review;
    }
}
