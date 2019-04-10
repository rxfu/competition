<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Repositories\UserRepository;
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

    public function store($data)
    {
        $object = parent::store($data);

        try {
            $object->departments()->sync($data['department']);
        } catch (QueryException $e) {
            throw new InternalException('创建院校分配失败', $this->repository->getObject(), 'store', $e);
        }
    }

    public function update($id, $data)
    {
        $object = $this->repository->update($id, $data);

        try {
            $object->departments()->sync($data['department']);
        } catch (QueryException $e) {
            throw new InternalException('更新院校分配失败', $this->repository->getObject(), 'update', $e);
        }
    }
}
