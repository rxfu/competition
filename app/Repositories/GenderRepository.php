<?php

namespace App\Repositories;

use App\Entities\Gender;

class GenderRepository extends Repository
{
    public function __construct(Gender $gender)
    {
        $this->object = $gender;
    }
}
