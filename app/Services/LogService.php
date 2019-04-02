<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Repositories\LogRepository;
use Illuminate\Support\Facades\Auth;

class LogService extends Service
{
    public function __construct(LogRepository $logs)
    {
        $this->repository = $logs;
    }

    public function getAll($order = 'created_at', $direction = 'desc')
    {
        return parent::getAll('created_at', 'desc');
    }

    public function write($level, $action, $model, $content)
    {
        $entity = basename(str_replace('\\', '/', $model));
        $content = is_array($content) ? $content : ['message' => $content];

        $data = [
            'user_id' => Auth::user()->id,
            'ip' => request()->ip(),
            'level' => $level,
            'path' => request()->path(),
            'method' => request()->method(),
            'action' => $action,
            'entity' => $entity,
            'content' => $content,
        ];

        try {
            $this->repository->store($data);
        } catch (Exception $e) {
            throw new GeneralException('日志保存失败', $this->repository->getModel(), 'update');
        }
    }
}
