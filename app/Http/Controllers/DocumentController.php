<?php

namespace App\Http\Controllers;

use App\Entities\Document;
use App\Entities\User;
use App\Services\DocumentService;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

class DocumentController extends BaseController
{
    protected $module = 'document';

    protected $storeRules = [
        'syllabus' => 'file|mimes:pdf',
        'design' => 'file|mimes:pdf',
        'section' => 'file|mimes:zip,rar',
        'catalog' => 'file|mimes:pdf',
    ];

    private $userService;

    private $upload_path;

    public function __construct(DocumentService $documentService, UserService $userService)
    {
        $this->service = $documentService;
        $this->userService = $userService;

        $this->updateRules = $this->storeRules;

        $this->upload_path = 'teaching/' . date('Y') . '/';
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $this->storeRules);

            $uploads = [
                'syllabus' => 'dagang',
                'design' => 'sheji',
                'section' => 'jieduan',
                'catalog' => 'mulu',
            ];

            foreach ($uploads as $upload => $file) {
                if ($request->has($upload)) {
                    $this->service->upload($request->file($upload), $request->input('user_id'), $upload, $file);
                }
            }
            // $this->service->upload($request->file('syllabus'), $request->input('user_id'), 'syllabus', 'dagang');
            // $this->service->upload($request->file('design'), $request->input('user_id'), 'design', 'sheji');
            // $this->service->upload($request->file('section'), $request->input('user_id'), 'section', 'jieduan');
            // $this->service->upload($request->file('catalog'), $request->input('user_id'), 'catalog', 'mulu');

            $data = [
                'application' => $request->input('application'),
            ];
            $this->service->update($request->input('user_id'), $data);

            return redirect()->route('player.index')->withSuccess('上传' . trans($this->module . '.module') . '成功');
        }
    }

    public function seq(Request $request)
    {
        if ($request->isMethod('put')) {
            $exists = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->whereGroupId(Auth::user()->group_id)->exists();
            if (!$exists) {
                if ($request->ajax()) {
                    return '选手身份证号不正确，请重新输入';
                } else {
                    return back()->withDanger('选手身份证号不正确，请重新输入');
                }
            }

            $player = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->whereGroupId(Auth::user()->group_id)->firstOrFail();
            $document = Document::find($player->id);

            if (is_null($document)) {
                if ($request->ajax()) {
                    return '选手未上传材料，不能抽签';
                } else {
                    return back()->withDanger('选手未上传材料，不能抽签');
                }
            }

            $seqs = [];
            if (!($drawed = $document->is_drawed)) {
                $players = User::has('document')
                    ->whereRoleId(config('setting.player'))
                    ->whereGroupId(Auth::user()->group_id)
                    ->get();

                $total = range(1, $players->count());
                foreach ($players as $player) {
                    if (!is_null($player->document->seq)) {
                        $seqs[] = $player->document->seq;
                    }
                }
                $surplus = array_diff($total, $seqs);
                $number = array_rand($surplus, 1);

                $document->seq = $surplus[$number];
                $document->is_drawed = true;

                if (!$document->save()) {
                    if ($request->ajax()) {
                        return '选手抽签号保存失败，请重新抽签！';
                    } else {
                        return back()->withDanger('选手抽签号保存失败，请重新抽签！');
                    }
                }
            }

            if ($request->ajax()) {
                return response()->json([
                    'seq' => $document->seq,
                    'is_drawed' => $drawed,
                    'seqs' => $seqs,
                ]);
            } else {
                return back()->withDrawed($drawed)->withSeq($document->seq)->withSuccess('选手' .  $player->name . '抽签号已保存');
            }
        }
    }

    public function secno(Request $request)
    {
        if ($request->isMethod('put')) {
            // $exists = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->whereGroupId(Auth::user()->group_id)->exists();
            $exists = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->exists();
            if (!$exists) {
                if ($request->ajax()) {
                    return '选手身份证号不正确，请重新输入';
                } else {
                    return back()->withDanger('选手身份证号不正确，请重新输入');
                }
            }

            // $player = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->whereGroupId(Auth::user()->group_id)->firstOrFail();
            $player = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->firstOrFail();
            $document = Document::find($player->id);

            if (is_null($document)) {
                if ($request->ajax()) {
                    return '选手未上传材料，不能抽节段';
                } else {
                    return back()->withDanger('选手未上传材料，不能抽节段');
                }
            }

            if (is_null($document->seq)) {
                if ($request->ajax()) {
                    return '选手未抽签，不能抽节段';
                } else {
                    return back()->withDanger('选手未抽签，不能抽节段');
                }
            }

            if (!($drawed = !empty($document->secno))) {
                $document->secno = random_int(1, 20);
                $document->save();
            }

            if ($request->ajax()) {
                return response()->json([
                    'secno' => $document->secno,
                    'is_drawed' => $drawed,
                ]);
            } else {
                return back()->withDrawed($drawed)->withSecno($document->secno)->withSuccess('选手' .  $player->name . '节段号已保存');
            }
        }
    }
}
