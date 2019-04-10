<?php

namespace App\Http\Controllers;

use App\Services\SubjectService;

class SubjectController extends BaseController
{
    protected $module = 'subject';

    protected $storeRules = [
        'name' => 'required',
    ];

    public function __construct(SubjectService $subjectService)
    {
        $this->service = $subjectService;

        $this->updateRules = $this->storeRules;
    }
}
