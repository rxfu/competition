<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\Services\DepartmentService;
use App\Services\UserService;

class UserController extends BaseController
{
    private $departmentService;

    public function __construct(UserService $userService, DepartmentService $departmentService)
    {
        $this->service = $userService;
        $this->departmentService = $departmentService;
    }

    public function store(SaveUserRequest $request)
    {
        return $this->postSave($request);
    }

    public function update(SaveUserRequest $request, $id)
    {
        return $this->putSave($request, $id);
    }
}
