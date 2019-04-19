<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use App\Services\RoleService;
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
    ];

    private $roleService;

    private $departmentService;

    public function __construct(UserService $userService, RoleService $roleService, DepartmentService $departmentService)
    {
        $this->service = $userService;
        $this->roleService = $roleService;
        $this->departmentService = $departmentService;

        $this->updateRules = [
            'username' => 'required|unique:users,username,' . request('id'),
            'name' => 'required',
            'email' => 'nullable|email',
            'is_enable' => 'required',
        ];
    }

    public function create()
    {
        $roles = $this->roleService->getAll();
        $departments = $this->departmentService->getEnabled();

        return parent::create()->with('roles', $roles)->with('departments', $departments);
    }

    public function edit($id)
    {
        $roles = $this->roleService->getAll();
        $departments = $this->departmentService->getEnabled();
        
        return parent::edit($id)->with('roles', $roles)->with('departments', $departments);
    }

    public function showUploadForm()
    {
        return view('pages.upload');
    }

    public function import(Request $request)
    {
        $this->service->import($request->file('upload'));

        return redirect()->route('user.index')->withSuccess('导入用户成功');
    }
}
