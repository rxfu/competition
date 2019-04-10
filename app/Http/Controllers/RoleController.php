<?php

namespace App\Http\Controllers;

use App\Services\RoleService;

class RoleController extends BaseController
{
    protected $module = 'role';

    protected $storeRules = [
        'name' => 'required',
    ];

    public function __construct(RoleService $roleService)
    {
        $this->service = $roleService;

        $this->updateRules = $this->storeRules;
    }
}
