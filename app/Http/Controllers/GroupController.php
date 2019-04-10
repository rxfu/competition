<?php

namespace App\Http\Controllers;

use App\Services\GroupService;

class GroupController extends BaseController
{
    protected $module = 'group';

    protected $storeRules = [
        'name' => 'required',
    ];

    public function __construct(GroupService $groupService)
    {
        $this->service = $groupService;

        $this->updateRules = $this->storeRules;
    }
}
