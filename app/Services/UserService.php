<?php

namespace App\Services;

use App\Entities\Review;
use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Imports\UserImport;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserService extends Service
{
    public function __construct(UserRepository $users)
    {
        $this->repository = $users;
    }

    public function changePassword($oldPassword, $newPassword, $confirmedPassword)
    {
        $credentials = [
            'username' => Auth::user()->username,
            'password' => $oldPassword,
        ];

        if (Auth::attempt($credentials)) {
            if ($newPassword === $confirmedPassword) {
                try {
                    $this->repository->update(Auth::id(), ['password' => $newPassword]);
                } catch (InvalidRequestException $e) {
                    throw new InvalidRequestException('修改密码失败', $this->repository->getObject(), 'update');
                }
            } else {
                throw new InvalidRequestException('确认密码与新密码不一致，请重新输入', $this->repository->getObject(), 'update');
            }
        } else {
            throw new InvalidRequestException('旧密码错误，请重新输入', $this->repository->getObject(), 'update');
        }
    }

    public function resetPassword($id)
    {
        try {
            $this->repository->update($id, ['password' => config('setting.password')]);
        } catch (InvalidRequestException $e) {
            throw new InvalidRequestException('重置密码失败', $this->repository->getObject(), 'update');
        }
    }

    public function hasPermission($id, $permission)
    {
        return $this->repository->hasPermission($id, $permission);
    }

    public function getAllPlayers($id = null)
    {
        return is_null($id) ? $this->repository->getAllPlayers() : $this->repository->getAllPlayersByDepartment($id);
    }

    public function getAllMarkers($id = null)
    {
        return is_null($id) ? $this->repository->getAllMarkers() : $this->repository->getAllMarkersByDepartment($id);
    }

    public function audit($id)
    {
        return $this->repository->update($id, ['is_passed' => true]);
    }

    public function unaudit($id)
    {
        return $this->repository->update($id, ['is_passed' => false]);
    }

    public function getAllPlayersByGroup($id)
    {
        return $this->repository->getAllPlayersByGroup($id);
    }

    public function getUser($username)
    {
        return $this->repository->getObject()->whereUsername($username)->first();
    }

    public function getAllByPlayers($id)
    {
        $reviews = Review::with('marker', 'player')
            ->wherePlayerId($id)
            ->where('year', '=', date('Y'))
            ->get();

        return $reviews;
    }

    public function import($file, $role, $department = null)
    {
        try {
            if (!is_null($file)) {
                Excel::import(new UserImport($role, $department), $file);
            } else {
                throw new InvalidRequestException('上传文件出错', $this->repository->getObject(), 'upload');
            }
        } catch (FileNotFoundException $e) {
            throw new InternalException('上传文件不存在', $this->repository->getObject(), 'upload', $e);
        }
    }

    public function confirm($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function getAllPlayersGroupByGroup()
    {
        return $this->repository->getObject()->with('group', 'document')->whereRoleId(config('setting.player'))->orderBy('group_id')->get();
    }

    public function upload($file, $userId, $filename)
    {
        try {
            if (!is_null($file)) {
                $ext = $file->clientExtension();
                $filename = $filename . '.' . $ext;
                $path = 'portrait';

                $success = $file->storeAs($path, $filename);
                $data = [
                    'portrait' => 'storage/' . $path . '/' . $filename,
                ];

                if ($success) {
                    $this->repository->update($userId, $data);
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

    public function recommend($file, $userId, $filename, $path)
    {
        try {
            if (!is_null($file)) {
                $ext = $file->clientExtension();
                $filename = $filename . '.' . $ext;

                $success = $file->storeAs($path, $filename);
                $data = [
                    'recommend' => 'storage/' . $path . '/' . $filename,
                ];

                if ($success) {
                    $this->repository->update($userId, $data);
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

    public function uploadSummary($file, $userId, $filename)
    {
        try {
            if (!is_null($file)) {
                $ext = $file->clientExtension();
                $filename = $filename . '.' . $ext;
                $path = 'summary';

                $success = $file->storeAs($path, $filename);
                $data = [
                    'summary' => 'storage/' . $path . '/' . $filename,
                ];

                if ($success) {
                    $this->repository->update($userId, $data);
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
}
