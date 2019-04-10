<?php

namespace App\Http\Controllers;

use App\Services\DegreeService;

class DegreeController extends BaseController
{
    protected $module = 'degree';

    protected $storeRules = [
        'name' => 'required',
    ];

    public function __construct(DegreeService $degreeService)
    {
        $this->service = $degreeService;

        $this->updateRules = $this->storeRules;
    }
}
