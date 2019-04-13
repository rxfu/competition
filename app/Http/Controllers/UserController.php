<?php

namespace App\Http\Controllers;

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

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->service = $userService;
        $this->roleService = $roleService;

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

        return parent::create()->with('roles', $roles);
    }

    public function edit($id)
    {
        $roles = $this->roleService->getAll();
        
        return parent::edit($id)->with('roles', $roles);
    }
}
