<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveDepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends BaseController
{
    protected $module = 'department';

    protected $storeRules = [
        'name' => 'required',
        'is_enable' => 'required',
    ];

    public function __construct(DepartmentService $departmentService)
    {
        $this->service = $departmentService;

        $this->updateRules = $this->storeRules;
    }
}
