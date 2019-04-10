<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;

class PermissionController extends BaseController
{
    protected $module = 'permission';

    protected $storeRules = [
        'slug' => 'required|unique:permissions',
        'name' => 'required',
    ];

    public function __construct(PermissionService $permissionService)
    {
        $this->service = $permissionService;

        $this->updateRules = [
            'slug' => 'required|unique:permissions,slug,' . request('id'),
            'name' => 'required',
        ];
    }
}
