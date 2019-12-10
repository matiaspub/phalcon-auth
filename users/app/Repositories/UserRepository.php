<?php


namespace App\Repositories;


use App\Models\Users;
use Phalcon\Di\Injectable;

class UserRepository extends Injectable
{
    public function attempt($login, $password)
    {
        $user = Users::findFirstByLogin($login);
        return $user && $this->security->checkHash($password, $user->password);
    }
}
