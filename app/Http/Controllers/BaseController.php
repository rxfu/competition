<?php

namespace App\Http\Controllers;

use App\Services\Service;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $service;

    protected $model;

    protected $modname;

    public function index()
    {
        $modname = $this->modname;
        $model = $this->model;

        $items = $this->service->getAll();
        
        return view('pages.list', compact('modname', 'model', 'items'));
    }

    public function create()
    {
        $modname = $this->modname;

        return view('pages.create', compact('modname'));
    }

    public function edit($id)
    {
        $modname = $this->modname;
        $model = $this->model;

        $item = $this->service->get($id);

        return view('pages.edit', compact('modname', 'model', 'item'));
    }

    public function postSave(Request $request)
    {
        $this->service->store($request->all());

        return back()->withSuccess('创建' . $this->modname . '成功');
    }

    public function putSave(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $this->service->update($id, $request->all());

            return back()->withSuccess('更新' . $this->modname . '成功');
        }
    }

    public function delete(Request $request)
    {
        $this->service->delete($request->input('items'));

        return redirect()->route($this->model . '.index')->withSuccess('删除' . $this->modname . '成功');
    }
}
