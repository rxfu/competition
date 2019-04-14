<?php

namespace App\Services;

use App\Repositories\ReviewRepository;

class ReviewService extends Service
{
    public function __construct(ReviewRepository $reviews)
    {
        $this->repository = $reviews;
    }

    public function store($data)
    {
        $attributes = [
            'year' => $data['year'],
            'marker_id' => $data['marker_id'],
            'player_id' => $data['player_id'],
        ];

        $this->repository->getObject()->updateOrCreate($attributes, $data);
    }
}
