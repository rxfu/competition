<?php

namespace App\Http\Controllers;

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

    protected $storeRules;

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
            'idnumber' => ['required', 'string', new Idnumber],
            'email' => 'required|email',
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
        $request->offsetSet('birthday', substr($request->idnumber, 6, 4) . '-' . substr($request->idnumber, 10, 2) . '-' . substr($request->idnumber, 12, 2));
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
        $request->offsetSet('birthday', substr($request->idnumber, 6, 4) . '-' . substr($request->idnumber, 10, 2) . '-' . substr($request->idnumber, 12, 2));

        return parent::update($request, $id);
    }

    public function audit($id)
    {
        $this->service->audit($id);

        return back()->withSuccess('专家 ' . $id . ' 审核通过');
    }

    public function design()
    {
        $items = $this->service->getAllPlayersByGroup(Auth::user()->group_id);

        return view('pages.design', compact('items'));
    }

    public function teaching()
    {
        $items = $this->service->getAllPlayersByGroup(Auth::user()->group_id);

        return view('pages.teaching', compact('items'));
    }
}
