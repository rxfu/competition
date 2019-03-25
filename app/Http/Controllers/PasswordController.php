<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
	private $service;

	public function __construct(UserService $userService) {
		$this->service = $userService;
	}

    public function password() {
    	return view('password.change');
    }

    public function change(ChangePasswordRequest $request) {
    	if ($request->isMethod('put')) {
			list($old, $password, $confirmed) = array_values($request->only('old_password', 'password', 'password_confirmation'));
	
			$this->service->changePassword($old, $password, $confirmed);
		}

		return back();
    }
}
