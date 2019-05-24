<?php

namespace App\Http\Controllers;

use App\Entities\Document;
use App\Entities\Setting;
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

class MarkerController extends BaseController
{
    protected $module = 'marker';

    protected $storeRules = [
        'name' => 'required',
        'idnumber' => 'required',
        'birthday' => 'required',
        'email' => 'required|email|unique:users',
        'position' => 'required',
        'major' => 'required',
        'phone' => 'required|unique:users',
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

        $this->updateRules = $this->storeRules = [
            // 'idnumber' => ['required', 'string', new Idnumber],
            'idnumber' => 'required',
            'birthday' => 'required',
            'email' => 'required|email|unique:users,email,' . request('id'),
            'position' => 'required',
            'major' => 'required',
            'phone' => 'required|unique:users,phone,' . request('id'),
        ];
    }

    public function index()
    {
        $department = Auth::user()->is_super ? null : Auth::user()->department_id;
        $items = $this->service->getAllMarkers($department);

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
        $request->offsetSet('role_id', config('setting.marker'));
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

    public function audit($id)
    {
        $this->service->audit($id);

        return back()->withSuccess('专家 ' . $id . ' 审核通过');
    }

    public function unaudit($id)
    {
        $this->service->unaudit($id);

        return back()->withSuccess('专家 ' . $id . ' 取消审核');
    }

    public function design()
    {
        if (Setting::whereIsEnable(false)->exists()) {
            $items = $this->service->getAllPlayersByGroup(Auth::user()->group_id);

            return view('pages.design', compact('items'));
        }

        return view('pages.error', ['message' => '教学设计评分系统已关闭！']);
    }

    public function teaching($id = null)
    {
        if (Setting::whereIsEnable(true)->exists()) {
            $exists = User::whereHas('document', function ($query) {
                $query->whereNotNull('seq');
            })->whereHas('playerReviews', function ($query) {
                $query->where('year', '=', date('Y'))->whereMarkerId(Auth::id())->whereNull('live_score');
            })->exists();

            if ($exists) {
                if (is_null($id)) {
                    $item = Document::whereHas('user', function ($query) {
                        $query->whereGroupId(Auth::user()->group_id)
                        ->whereRoleId(config('setting.player'))
                        ->whereHas('playerReviews', function ($q) {
                                    $q->where('year', '=', date('Y'))->whereMarkerId(Auth::id())->whereNull('live_score');
                        });
                    })
                    ->where('year', '=', date('Y'))
                    ->whereNotNull('seq')
                    ->orderBy('seq')
                    ->first(['user_id', 'seq']);

                    return view('pages.teaching-confirm', compact('item'));
                } else {
                    $item = $this->service->get($id);
                    
                    return view('pages.teaching', compact('item'));
                }
            } else {
                $items = $this->service->getAllPlayersByGroup(Auth::user()->group_id);
        
                return view('pages.teaching-list', compact('items'));
            }
        }

        return view('pages.error', ['message' => '课堂教学评分系统已关闭！']);
    }

    public function showUploadForm()
    {
        return view('pages.upload');
    }

    public function import(Request $request)
    {
        $this->service->import($request->file('upfile'), config('setting.marker'), Auth::user()->department_id);

        return redirect()->route('marker.index')->withSuccess('导入专家成功');
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
    
            return redirect()->route('home.dashboard')->withSuccess('专家' . Auth::user()->name . '信息已确认');
        }
    }
}
