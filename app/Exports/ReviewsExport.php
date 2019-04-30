<?php

namespace App\Exports;

use App\Entities\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReviewsExport implements FromView
{
    private $group;

    public function __construct($group)
    {
        $this->group = $group;
    }

    public function view(): View
    {
        $players = User::whereRoleId(config('setting.player'))->whereGroupId($this->group->id)->get();

        return view('exports.review', [
            'players' => $players,
            'group' => $this->group,
        ]);
    }
}
