<?php

namespace app\controllers;

use app\model\repositories\BasketRepository;
use app\model\entities\Basket;
use app\engine\{Request};

class BasketController extends Controller
{
    public function actionBasket()
    {
        $basket = (new BasketRepository)->getBasket();
        $sum_order = (new BasketRepository)->sum_order($basket);

        echo $this->renderLayouts("basket", [
            "basket" => $basket,
            'sum_order' => $sum_order
        ]);
    }

    public function actionBuy()
    {
        $id = (new Request())->getParams()['id'];
        $good = (new BasketRepository)->getOne($id);
        $good->basketUp();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


    public function actionDelete()
    {
        $requset = (new Request())->getParams();
        $id = $requset['id'];
        $basket = (new BasketRepository())->getOne($id);

        if ((int)$basket->quantity <= 1) {
            $basket->delete();
        } else {
            $basket->basketRemove();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
