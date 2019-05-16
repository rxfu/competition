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
        'syllabus' => 'required|file|mimes:pdf',
        'design' => 'required|file|mimes:pdf',
        'section' => 'required|file|mimes:zip,rar',
        'catalog' => 'required|file|mimes:pdf',
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

            $this->service->upload($request->file('syllabus'), $request->input('user_id'), 'syllabus', 'dagang');
            $this->service->upload($request->file('design'), $request->input('user_id'), 'design', 'sheji');
            $this->service->upload($request->file('section'), $request->input('user_id'), 'section', 'jieduan');
            $this->service->upload($request->file('catalog'), $request->input('user_id'), 'catalog', 'mulu');

            $data = [
                'application' => $request->only('application'),
            ];
            $this->service->update($request->input('user_id'), $data);

            return redirect()->route('player.index')->withSuccess('上传' . trans($this->module . '.module') . '成功');
        }
    }

    public function seq(Request $request)
    {
        if ($request->isMethod('put')) {
            $player = User::whereIdnumber($request->input('idnumber'))->whereRoleId(config('setting.player'))->whereGroupId(Auth::user()->group_id)->firstOrFail();
            $document = Document::findOrFail($player->id);

            $document->is_drawed = true;
            $document->save();
            
            return back()->withSeq($document->seq)->withSuccess('选手' .  $player->name . '抽签号已保存');
        }
    }
}
