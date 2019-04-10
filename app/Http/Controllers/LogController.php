<?php

namespace App\Http\Controllers;

use App\Services\LogService;
use Illuminate\Http\Request;

class LogController extends BaseController
{
    public function __construct(LogService $logService)
    {
        $this->service = $logService;
    }
}
