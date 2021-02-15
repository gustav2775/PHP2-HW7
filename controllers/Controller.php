<?php

namespace app\controllers;

use app\interfaces\{ILogin, IRender};
use app\engine\Session;
use app\model\repositories\{UsersRepository,BasketRepository};

class Controller
{
    private $defaultLayouts = "index";
    protected $render;

    public function __construct(IRender $render)
    {
        $this->render = $render;
    }

    public function renderLayouts($template, $params = [])
    {
        $id = (new Session)->getSession()['id'];
        if(isset($id)){
            $params['is_admin'] = (new UsersRepository)->getOne($id)->is_admin();
        }
        return $this->render->renderVeiws(LAYOUTS . $this->defaultLayouts, [
            'login' => $this->render->renderVeiws('login', [
                'login' =>(new UsersRepository)->getLogin(),
                'auth' => (new UsersRepository)->auth(),
            ]),
            'menu' => $this->render->renderVeiws('menu', [
                'count' => (new BasketRepository)->getCount()['count'],
            ]),
            'content' => $this->render->renderVeiws($template, $params)
        ]);
    }
}
