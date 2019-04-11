<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use App\Services\UserService;
use Illuminate\Http\Request;

class DocumentController extends BaseController
{
    protected $module = 'document';

    private $userService;

    private $upload_path;

    public function __construct(DocumentService $documentService, UserService $userService)
    {
        $this->service = $documentService;
        $this->userService = $userService;

        $this->upload_path = 'teaching/' . date('Y') . '/';
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = $this->userService->get($request->input('user_id'));

            $syllabus = $request->file('syllabus')->storeAs($this->upload_path . $user->phone, 'dagang');
            $design = $request->file('design')->storeAs($this->upload_path . $user->phone, 'sheji');
            $section = $request->file('section')->storeAs($this->upload_path . $user->phone, 'jieduan');
            $catalog = $request->file('catalog')->storeAs($this->upload_path . $user->phone, 'mulu');

            if ($syllabus && $design && $section && $catalog) {
                return parent::store($request);
            } else {
                return back()->withDanger('文件上传失败');
            }
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $user = $this->userService->get($request->input('user_id'));

            $syllabus = $request->file('syllabus')->storeAs($this->upload_path . $user->phone, 'dagang');
            $design = $request->file('design')->storeAs($this->upload_path . $user->phone, 'sheji');
            $section = $request->file('section')->storeAs($this->upload_path . $user->phone, 'jieduan');
            $catalog = $request->file('catalog')->storeAs($this->upload_path . $user->phone, 'mulu');

            if ($syllabus && $design && $section && $catalog) {
                return parent::update($request, $id);
            } else {
                return back()->withDanger('文件上传失败');
            }
        }
    }
}
