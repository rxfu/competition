<?php

namespace App\Http\Controllers;

use Auth;
use App\Entities\User;
use App\Entities\Setting;
use App\Entities\Document;
use App\Rules\IdnumberMarker;
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

class MarkerController extends BaseController
{
    protected $module = 'marker';

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
            'birthday' => 'required_if:idtype,1',
            'email' => 'required|email|unique:users',
            'title' => 'required',
            'major' => 'required',
            'phone' => 'required|unique:users',
            'portrait' => 'required',
        ];

        $this->updateRules = [
            'idtype' => 'required',
            'idnumber' => 'required|string',
            // 'idnumber' => 'required',
            'birthday' => 'required_if:idtype,1',
            'email' => 'required|email|unique:users,email,' . request('id'),
            'title' => 'required',
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
        $request->offsetSet('is_enable', true);
        $request->offsetSet('is_super', false);
        $request->offsetSet('creator_id', Auth::id());
        $request->offsetSet('role_id', config('setting.marker'));
        $request->offsetSet('department_id', Auth::user()->department_id);

        if ($request->idtype == 0) {
            $request->offsetSet('birthday', substr($request->idnumber, 6, 4) . '-' . substr($request->idnumber, 10, 2) . '-' . substr($request->idnumber, 12, 2));
        }

        $v = Validator::make($request->all(), $this->storeRules);
        $v->sometimes('idnumber', new IdnumberMarker, function ($input) {
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
            $v->sometimes('idnumber', new IdnumberMarker, function ($input) {
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

    public function pdf($id)
    {
        $marker = $this->service->get($id);

        $pdf = PDF::loadView('exports.marker', compact('marker'));

        return $pdf->download($marker->name . '.pdf');
    }

    public function showRecommendationForm($id)
    {
        $item = $this->service->get($id);
        return view('pages.recommend', compact('item'));
    }

    public function recommend(Request $request, $id)
    {
        $item = $this->service->get($id);
        $this->service->recommend($request->file('upfile'), $item->id, $item->idnumber, 'marker');

        return redirect()->route('marker.index')->withSuccess('上传推荐表成功');
    }
}
