<?php

namespace app\model\repositories;

use app\model\enitities\Users;
use app\model\Repository;
use app\engine\Session;

class UsersRepository extends Repository
{

    public  function getTableName()
    {
        return 'users';
    }

    public  function auth()
    {
        $session = (new Session())->getSession();
        $cookie = (new Session())->getCookie();
        if (isset($session['login'])) {
            $user = $this->getOne($session['login'],'login');
            if (!empty($user)) {
                return  true;
            }
        }
        if ($_COOKIE['hash']) {
            $user =  $this->getOne($cookie['hash'],'hash');
            if (isset($user)) {
                $_SESSION['login'] = $user['login'];
                return  true;
            }
        }
    }

    public function getLogin()
    {
        return (new Session())->getSession()['login'];
    }

    public function is_admin()
    {
        if ($this->login === "admin") return true;
    }
}
