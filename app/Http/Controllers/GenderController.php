<?php

namespace App\Http\Controllers;

use App\Services\GenderService;

class GenderController extends BaseController
{
    protected $module = 'gender';

    protected $storeRules = [
        'name' => 'required',
    ];

    public function __construct(GenderService $genderService)
    {
        $this->service = $genderService;

        $this->updateRules = $this->storeRules;
    }
}
