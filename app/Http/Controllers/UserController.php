<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\Services\DepartmentService;
use App\Services\UserService;

class UserController extends BaseController
{
    protected $module = 'user';

    protected $storeRules = [
        'username' => 'required|unique:users',
        'password' => 'required|min:6',
        'name' => 'required',
        'email' => 'nullable|email',
        'is_enable' => 'required',
        'is_super' => 'required',
    ];

    private $departmentService;

    public function __construct(UserService $userService, DepartmentService $departmentService)
    {
        $this->service = $userService;
        $this->departmentService = $departmentService;

        $this->updateRules = [
            'username' => 'required|unique:users,username,' . request('id'),
            'name' => 'required',
            'email' => 'nullable|email',
            'is_enable' => 'required',
            'is_super' => 'required',
        ];
    }

    public function create()
    {
        $departments = $this->departmentService->getEnabled();

        return parent::create()->with('departments', $departments);
    }

    public function edit($id)
    {
        $departments = $this->departmentService->getEnabled();
        
        return parent::edit($id)->with('departments', $departments);
    }
}
