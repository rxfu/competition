<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use App\Services\GroupService;
use App\Services\RoleService;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $module = 'user';

    protected $storeRules = [
        'username' => 'required|unique:users',
        'password' => 'required|min:6',
        'name' => 'required',
        'email' => 'nullable|email|unique:users',
        'is_enable' => 'required',
    ];

    private $roleService;

    private $departmentService;

    private $groupService;

    public function __construct(UserService $userService, RoleService $roleService, DepartmentService $departmentService, GroupService $groupService)
    {
        $this->service = $userService;
        $this->roleService = $roleService;
        $this->departmentService = $departmentService;
        $this->groupService = $groupService;

        $this->updateRules = [
            'username' => 'required|unique:users,username,' . request('id'),
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email,' . request('id'),
            'is_enable' => 'required',
        ];
    }

    public function create()
    {
        $roles = $this->roleService->getAll();
        $departments = $this->departmentService->getEnabled();
        $groups = $this->groupService->getAll();

        return parent::create()->with('roles', $roles)->with('departments', $departments)->with('groups', $groups);
    }

    public function edit($id)
    {
        $roles = $this->roleService->getAll();
        $departments = $this->departmentService->getEnabled();
        $groups = $this->groupService->getAll();

        return parent::edit($id)->with('roles', $roles)->with('departments', $departments)->with('groups', $groups);
    }

    public function showUploadForm()
    {
        return view('pages.upload');
    }

    public function import(Request $request)
    {
        $this->service->import($request->file('upfile'), config('setting.manager'));

        return redirect()->route('user.index')->withSuccess('导入用户成功');
    }

    public function showConfirmForm($id)
    {
        $item = $this->service->get($id);

        return view('pages.confirm', compact('item'));
    }

    public function confirm(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email|unique:users,email,' . request('id'),
                'leader' => 'required',
                'leader_phone' => 'required',
            ]);
    
            $request->offsetSet('is_confirmed', true);
    
            $this->service->confirm($id, $request->all());
    
            return redirect()->route('home.dashboard')->withSuccess('用户' . Auth::user()->name . '信息已确认');
        }
    }
}
