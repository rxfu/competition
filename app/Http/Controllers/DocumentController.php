<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use App\Services\UserService;
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

            return redirect()->route('player.index')->withSuccess('上传' . trans($this->module . '.module') . '成功');
        }
    }

    public function seq(Request $request)
    {
        if ($request->isMethod('put')) {
            foreach ($request->input('seq') as $id => $seq) {
                $data = [
                    'year' => date('Y'),
                    'seq' => $seq,
                ];

                $this->service->save($id, $data);
            }
            
            return back()->withSuccess('选手抽签号已保存');
        }
    }
}
