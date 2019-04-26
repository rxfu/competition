<?php

namespace App\Services;

use App\Exceptions\InternalException;
use App\Repositories\DocumentRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class DocumentService extends Service
{
    private $path;

    private $users;

    public function __construct(DocumentRepository $documents, UserRepository $users)
    {
        $this->repository = $documents;
        $this->users = $users;
        $this->path = 'teaching/' . date('Y') . '/';
    }

    public function getAll()
    {
        return $this->repository->getAll('user_id');
    }

    public function upload($file, $userId, $type, $filename)
    {
        try {
            if (!is_null($file)) {
                $user = $this->users->get($userId);
    
                $ext = $file->clientExtension();
                $filename = $filename . '.' . $ext;
                $path = $this->path . $user->group_id . '-' . $user->phone;
    
                $success = $file->storeAs($path, $filename);
                $data = [
                    'year' => date('Y'),
                    'user_id' => $user->id,
                    $type => 'storage/' . $path . '/' . $filename,
                ];
    
                if ($success) {
                    $this->repository->getObject()->updateOrCreate(['user_id' => $user->id], $data);
                } else {
                    throw new InvalidRequestException('上传文件失败', $this->repository->getObject(), 'update');
                }
            }
        } catch (FileNotFoundException $e) {
            throw new InternalException('上传文件不存在', $this->repository->getObject(), 'upload', $e);
        } catch (QueryException $e) {
            throw new InternalException('上传文件更新数据失败', $this->repository->getObject(), 'update', $e);
        }
    }

    public function save($id, $data)
    {
        try {
            $user = $this->users->get($id);
    
            $this->repository->getObject()->updateOrCreate(['user_id' => $user->id], $data);
        } catch (QueryException $e) {
            throw new InternalException('保存抽签号失败', $this->repository->getObject(), 'save', $e);
        }
    }
}
