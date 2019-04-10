<?php

namespace App\Repositories;

use App\Entities\Degree;

class DegreeRepository extends Repository
{
    public function __construct(Degree $degree)
    {
        $this->object = $degree;
    }
}
