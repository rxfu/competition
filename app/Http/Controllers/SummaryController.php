<?php

namespace App\Http\Controllers;

use App\Entities\Group;
use App\Exports\ReviewsExport;
use App\Services\UserService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

        return view('pages.list', compact('items'));
    }

    public function rank()
    {
        $groups = Group::all();

        $ranks = [];
        foreach ($groups as $group) {
            $players = $this->service->getAllPlayersByGroup($group->id);

            $ranks[$group->id]['title'] = $group->name;
            $ranks[$group->id]['items'] = $players;
            ;
        }

        return view('pages.summary-rank', compact('ranks'));
    }

    public function detail($id)
    {
        $items = $this->service->getAllByPlayers($id);

        return view('pages.summary-detail', compact('items'));
    }

    public function export($id)
    {
        $group = Group::findOrFail($id);

        return Excel::download(new ReviewsExport($group), '全区高校青年教师教学竞赛计分表（' . $group->name . '）.xlsx');
    }
}
