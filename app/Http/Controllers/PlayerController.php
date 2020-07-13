<?php

namespace App\Http\Controllers;

use Auth;
use App\Entities\User;
use App\Rules\Idnumber;
use App\Entities\Document;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\GroupService;
use App\Services\DegreeService;
use App\Services\GenderService;
use App\Services\SubjectService;
use App\Services\EducationService;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Validator;
use PDF;

class PlayerController extends BaseController
{
    protected $module = 'player';

    private $genderService;

    private $educationService;

    private $degreeService;

    private $departmentService;

    private $subjectService;

    private $groupService;

    public function __construct(UserService $userService, GenderService $genderService, EducationService $educationService, DegreeService $degreeService, DepartmentService $departmentService, SubjectService $subjectService, GroupService $groupService)
    {
        $this->service = $userService;
        $this->genderService = $genderService;
        $this->educationService = $educationService;
        $this->degreeService = $degreeService;
        $this->departmentService = $departmentService;
        $this->subjectService = $subjectService;
        $this->groupService = $groupService;

        $this->storeRules = [
            'name' => 'required',
            'idtype' => 'required',
            'idnumber' => 'required|string',
            // 'idnumber' => 'required',
            'birthday' => 'required_if:idtype,1|after:1980-8-31',
            'title' => 'required',
            'teaching_begin_time' => 'required|before_or_equal:2016-7-30',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'course' => 'required',
            'project' => 'required',
            'portrait' => 'required',
        ];

        $this->updateRules = [
            'name' => 'required',
            'idtype' => 'required',
            'idnumber' => 'required|string',
            // 'idnumber' => 'required',
            'birthday' => 'required_if:idtype,1|after:1980-8-31',
            'title' => 'required',
            'teaching_begin_time' => 'required|before_or_equal:2016-7-30',
            'phone' => 'required|unique:users,phone,' . request('id'),
            'email' => 'required|email|unique:users,email,' . request('id'),
            'course' => 'required',
            'project' => 'required',
        ];
    }

    public function index()
    {
        $department = Auth::user()->is_super ? null : Auth::user()->department_id;

        if (config('setting.player') === Auth::user()->role_id) {
            $items = User::whereId(Auth::id())->get();
        } else {
            $items = $this->service->getAllPlayers($department);
        }

        return view('pages.list', compact('items'));
    }

    public function create()
    {
        $genders = $this->genderService->getAll();
        $educations = $this->educationService->getAll();
        $degrees = $this->degreeService->getAll();
        $departments = $this->departmentService->getAll();
        $subjects = $this->subjectService->getAll();
        $groups = $this->groupService->getAll();

        return view('pages.create', compact('genders', 'educations', 'degrees', 'departments', 'subjects', 'groups'));
    }

    public function store(Request $request)
    {
        $request->offsetSet('username', $request->phone);
        $request->offsetSet('password', substr($request->idnumber, -6));
        $request->offsetSet('is_enable', true);
        $request->offsetSet('is_super', false);
        $request->offsetSet('creator_id', Auth::id());
        $request->offsetSet('role_id', config('setting.player'));
        $request->offsetSet('department_id', Auth::user()->department_id);

        if ($request->idtype == 0) {
            $request->offsetSet('birthday', substr($request->idnumber, 6, 4) . '-' . substr($request->idnumber, 10, 2) . '-' . substr($request->idnumber, 12, 2));
        }

        $v = Validator::make($request->all(), $this->storeRules);
        $v->sometimes('idnumber', new Idnumber, function ($input) {
            return $input->idtype == 0;
        });

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }

        $user = $this->service->store($request->all());
        $this->service->upload($request->file('portrait'), $user->id, $user->idnumber);

        return redirect()->route($this->module . '.index')->withSuccess('创建' . trans($this->module . '.module') . '成功');
    }

    public function edit($id)
    {
        $genders = $this->genderService->getAll();
        $educations = $this->educationService->getAll();
        $degrees = $this->degreeService->getAll();
        $departments = $this->departmentService->getAll();
        $subjects = $this->subjectService->getAll();
        $groups = $this->groupService->getAll();
        $item = $this->service->get($id);

        return view('pages.edit', compact('item', 'genders', 'educations', 'degrees', 'departments', 'subjects', 'groups'));
    }

    public function update(Request $request, $id)
    {
        if ($request->idtype == 0) {
            $request->offsetSet('birthday', substr($request->idnumber, 6, 4) . '-' . substr($request->idnumber, 10, 2) . '-' . substr($request->idnumber, 12, 2));
        }

        if ($request->isMethod('put')) {
            $v = Validator::make($request->all(), $this->updateRules);
            $v->sometimes('idnumber', new Idnumber, function ($input) {
                return $input->idtype == 0;
            });

            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            }

            $this->service->update($id, $request->all());
            $this->service->upload($request->file('portrait'), $id, $request->idnumber);

            return redirect()->route($this->module . '.index')->withSuccess('更新' . trans($this->module . '.module') . '成功');
        }
    }

    public function document($id)
    {
        $item = $this->service->get($id);

        return view('pages.document', compact('item'));
    }

    public function showUploadForm()
    {
        return view('pages.upload');
    }

    public function import(Request $request)
    {
        $this->service->import($request->file('upfile'), config('setting.player'), Auth::user()->department_id);

        return redirect()->route('player.index')->withSuccess('导入选手成功');
    }

    public function showConfirmForm($id)
    {
        $genders = $this->genderService->getAll();
        $educations = $this->educationService->getAll();
        $degrees = $this->degreeService->getAll();
        $departments = $this->departmentService->getAll();
        $subjects = $this->subjectService->getAll();
        $groups = $this->groupService->getAll();
        $item = $this->service->get($id);

        return view('pages.confirm', compact('item', 'genders', 'educations', 'degrees', 'departments', 'subjects', 'groups'));
    }

    public function confirm(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $request->offsetSet('is_confirmed', true);

            $this->service->confirm($id, $request->all());

            return redirect()->route('home.dashboard')->withSuccess('选手' . Auth::user()->name . '信息已确认');
        }
    }

    public function showSeqForm()
    {
        $allDrawed = true;

        if (Auth::user()->is_super) {
            $items = $this->service->getAllPlayers();
        } else {
            $items = $this->service->getAllPlayersByGroup(Auth::user()->group_id);

            foreach ($items as $item) {
                if ($item->document && is_null($item->document->seq)) {
                    $allDrawed = false;
                }
            }
        }

        if ($allDrawed) {
            return view('pages.seq', compact('items'));
        } else {
            return redirect()->route('player.draw');
        }
    }

    public function draw()
    {
        /* $players = User::has('document')
            ->whereRoleId(config('setting.player'))
            ->whereGroupId(Auth::user()->group_id)
            ->get();

        if (empty($players[0]->document->seq)) {
            $seqs = range(1, $players->count());
            shuffle($seqs);

            foreach ($players as $idx => $player) {
                $document = Document::find($player->id);

                if ($document) {
                    $document->seq = $seqs[$idx];
                    $document->save();
                }
            }
        } */
        $players = User::has('document')
            ->whereRoleId(config('setting.player'))
            ->whereGroupId(Auth::user()->group_id)
            ->get();

        $seqs = [];
        foreach ($players as $player) {
            if (!is_null($player->document->seq)) {
                $seqs[] = $player->document->seq;
            }
        }

        return view('pages.draw', compact('players', 'seqs'));
    }

    public function pdf($id)
    {
        $player = $this->service->get($id);

        $pdf = PDF::loadView('exports.player', compact('player'));

        return $pdf->download($player->name . '.pdf');
    }

    public function showRecommendationForm($id)
    {
        $item = $this->service->get($id);
        return view('pages.recommend', compact('item'));
    }

    public function recommend(Request $request, $id)
    {
        $item = $this->service->get($id);
        $this->service->recommend($request->file('upfile'), $item->id, $item->idnumber, 'player');

        return redirect()->route('player.index')->withSuccess('上传推荐表成功');
    }

    public function showSecnoForm()
    {
        $allDrawed = true;

        if (Auth::user()->is_super) {
            $items = $this->service->getAllPlayers();
        } else {
            $items = $this->service->getAllPlayersByGroup(Auth::user()->group_id);

            foreach ($items as $item) {
                if ($item->document && is_null($item->document->seq)) {
                    $allDrawed = false;
                }
            }
        }

        if ($allDrawed) {
            return view('pages.secno', compact('items'));
        } else {
            return redirect()->route('player.draw-secno');
        }
    }

    public function drawSecno()
    {
        return view('pages.secno-draw');
    }
}
