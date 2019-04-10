<?php

namespace App\Http\Controllers;

use App\Services\SettingService;

class SettingController extends BaseController
{
    protected $module = 'setting';

    protected $storeRules = [
        'slug' => 'required|unique:settings',
        'name' => 'required',
        'is_enable' => 'required',
        'begin_at' => 'nullable|date',
        'end_at' => 'nullable|date',
    ];

    public function __construct(SettingService $settingService)
    {
        $this->service = $settingService;

        $this->updateRules = [
            'slug' => 'required|unique:settings,slug,' . request('id'),
            'name' => 'required',
            'is_enable' => 'required',
            'begin_at' => 'nullable|date',
            'end_at' => 'nullable|date',
        ];
    }
}
