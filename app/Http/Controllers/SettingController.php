<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSettingRequest;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function __construct(SettingService $settingService, SaveSettingRequest $request)
    {
        $this->service = $settingService;
        $this->request = $request;
    }

    public function store(SaveSettingRequest $request)
    {
        return $this->postSave($request);
    }

    public function update(SaveSettingRequest $request, $id)
    {
        return $this->putSave($request, $id);
    }
}
