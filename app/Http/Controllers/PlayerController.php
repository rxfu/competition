<?php

namespace App\Http\Controllers;

use App\Entities\Document;
use App\Entities\User;
use App\Rules\Idnumber;
use App\Services\DegreeService;
use App\Services\DepartmentService;
use App\Services\EducationService;
use App\Services\GenderService;
use App\Services\GroupService;
use App\Services\SubjectService;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

class PlayerController extends BaseController
{
    protected $module = 'player';

    protected $storeRules = [
        'name' => 'required',
        'idnumber' => 'required',
        'birthday' => 'required',
        'position' => 'required',
        'teaching_begin_time' => 'required',
        'phone' => 'required',
        'course' => 'required',
    ];

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

        $this->updateRules = $this->storeRules;
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
        // $request->offsetSet('birthday', substr($request->idnumber, 6, 4) . '-' . substr($request->idnumber, 10, 2) . '-' . substr($request->idnumber, 12, 2));
        $request->offsetSet('is_enable', true);
        $request->offsetSet('is_super', false);
        $request->offsetSet('creator_id', Auth::id());
        $request->offsetSet('role_id', config('setting.player'));
        $request->offsetSet('department_id', Auth::user()->department_id);

        return parent::store($request);
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
        // $request->offsetSet('birthday', substr($request->idnumber, 6, 4) . '-' . substr($request->idnumber, 10, 2) . '-' . substr($request->idnumber, 12, 2));

        return parent::update($request, $id);
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
        if (Auth::user()->is_super) {
            $items = $this->service->getAllPlayers();
        } else {
            $items = $this->service->getAllPlayersByGroup(Auth::user()->group_id);
        }

        return view('pages.seq', compact('items'));
    }

    public function draw()
    {
        $players = User::has('document')
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
        }

        return view('pages.draw');
    }
}
