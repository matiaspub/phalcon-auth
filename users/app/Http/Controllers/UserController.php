<?php


namespace App\Http\Controllers;


use App\Http\Exceptions\Http403Exception;
use App\Models\Users;

class UserController extends ControllerBase
{
    public function list()
    {
        return Users::find(['columns' => ['id', 'login']]);
    }

    public function login()
    {
        $login = $this->request->get('login');
        $password = $this->request->get('password');
        $user = Users::findFirstByLogin($login);
        if ($user && $this->security->checkHash($password, $user->password)) {
            return ['status' => 'success'];
        }
        throw new Http403Exception();
    }
}
