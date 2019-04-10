<?php

namespace App\Http\Controllers;

use App\Services\EducationService;

class EducationController extends BaseController
{
    protected $module = 'education';

    protected $storeRules = [
        'name' => 'required',
    ];

    public function __construct(EducationService $educationService)
    {
        $this->service = $educationService;

        $this->updateRules = $this->storeRules;
    }
}
