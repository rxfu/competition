<?php

namespace App\Repositories;

use App\Entities\Subject;

class SubjectRepository extends Repository
{
    public function __construct(Subject $subject)
    {
        $this->object = $subject;
    }
}
