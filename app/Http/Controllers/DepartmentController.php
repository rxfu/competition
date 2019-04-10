<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveDepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends BaseController
{
    public function __construct(DepartmentService $departmentService, SaveDepartmentRequest $request)
    {
        $this->service = $departmentService;
        $this->request = $request;
    }

    public function store(SaveDepartmentRequest $request)
    {
        return $this->postSave($request);
    }

    public function update(SaveDepartmentRequest $request, $id)
    {
        return $this->putSave($request, $id);
    }
}
