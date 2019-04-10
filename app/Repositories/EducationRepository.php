<?php

namespace App\Repositories;

use App\Entities\Education;

class EducationRepository extends Repository
{
    public function __construct(Education $education)
    {
        $this->object = $education;
    }
}
