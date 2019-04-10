<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePermissionRequest;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    public function __construct(PermissionService $permissionService, SavePermissionRequest $request)
    {
        $this->service = $permissionService;
        $this->request = $request;
    }

    public function store(SavePermissionRequest $request)
    {
        return $this->postSave($request);
    }

    public function update(SavePermissionRequest $request, $id)
    {
        return $this->putSave($request, $id);
    }
}
