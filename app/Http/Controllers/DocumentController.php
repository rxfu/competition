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
            $this->service->upload($request->file('syllabus'), $request->input('user_id'), 'syllabus', 'dagang');
            $this->service->upload($request->file('design'), $request->input('user_id'), 'design', 'sheji');
            $this->service->upload($request->file('section'), $request->input('user_id'), 'section', 'jieduan');
            $this->service->upload($request->file('catalog'), $request->input('user_id'), 'catalog', 'mulu');

            return redirect()->route($this->module . '.index')->withSuccess('上传' . trans($this->module . '.module') . '成功');
        }
    }

    public function update(Request $request, $id)
    {
        return $this->store($request);
    }
}
