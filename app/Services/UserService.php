<?php

namespace App\Services;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Repositories\UserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

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
}
