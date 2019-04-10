<?php

namespace App\Services;

use App\Repositories\EducationRepository;

class EducationService extends Service
{
    public function __construct(EducationRepository $educations)
    {
        $this->repository = $educations;
    }
}
