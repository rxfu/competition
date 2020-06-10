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
                return back()->withDanger('选手身份证号不正确，请重新输入');
            }

            $player = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->whereGroupId(Auth::user()->group_id)->firstOrFail();
            $document = Document::findOrFail($player->id);

            if ($drawed = empty($document->seq)) {
                $players = User::has('document')
                    ->whereRoleId(config('setting.player'))
                    ->whereGroupId(Auth::user()->group_id)
                    ->get();

                $total = range(1, $players->count());
                $seqs = [];
                foreach ($players as $player) {
                    $seqs[] = $player->document->seq;
                }
                $surplus = array_diff($total, $seqs);
                $number = array_rand($surplus, 1);

                $document->seq = $surplus[$number];
                $document->is_drawed = true;
                $document->save();
            }

            return back()->withDrawed($drawed)->withSeq($document->seq)->withSuccess('选手' .  $player->name . '抽签号已保存');
        }
    }

    public function secno(Request $request)
    {
        if ($request->isMethod('put')) {
            $exists = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->whereGroupId(Auth::user()->group_id)->exists();
            if (!$exists) {
                return back()->withDanger('选手身份证号不正确，请重新输入');
            }

            $player = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->whereGroupId(Auth::user()->group_id)->firstOrFail();
            $document = Document::findOrFail($player->id);

            if ($drawed = empty($document->secno)) {
                $document->secno = random_int(1, 20);
                $document->save();
            }

            return back()->withDrawed($drawed)->withSecno($document->secno)->withSuccess('选手' .  $player->name . '节段号已保存');
        }
    }
}
