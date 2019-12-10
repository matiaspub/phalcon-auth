<?php


namespace App\Http\Controllers;


use App\Http\Exceptions\Http403Exception;
use App\Models\Users;
use App\Repositories\UserRepository;

class UserController extends ControllerBase
{
    /**
     * @var UserRepository
     */
    protected $users;

    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function list()
    {
        return Users::find(['columns' => ['id', 'login']]);
    }

    public function login()
    {
        $login = $this->request->get('login');
        $password = $this->request->get('password');

        if ($this->users->attempt($login, $password)) {
            return ['status' => 'success'];
        }
        throw new Http403Exception();
    }
}
