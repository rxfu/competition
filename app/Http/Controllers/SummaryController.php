<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    private $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function player()
    {
        $items = $this->service->getAllPlayers();

        return view('pages.summary-player', compact('items'));
    }

    public function marker()
    {
        $items = $this->service->getAllMarkers();

        return view('pages.summary-marker', compact('items'));
    }
}
