<?php

namespace app\controllers;

use app\model\entities\{Catalog, Basket, Feedback};
use app\model\repositories\{CatalogRepository, FeedbackRepository, BasketRepository};
use app\engine\Request;

class CatalogController extends Controller
{
    public function actionCatalog()
    {
        $page = (new Request())->getParams()['page'] ?: 10;
        $catalog = (new CatalogRepository)->getAllLimit($page);

        echo $this->renderLayouts("catalog", [
            "catalog" => $catalog,
            'page' => $page
        ]);
    }

    public function actionProduct()
    {
        $id = (new Request())->getParams()['id'];
        $catalog = (new CatalogRepository)->getOneArray($id);
        $feedback = (new FeedbackRepository)->getAllWhere($id);

        echo $this->renderLayouts("product", [
            "item" => $catalog,
            "feedback" => $feedback
        ]);
    }

    // public function actionInsert()
    // {
    //     $params = (new Request())->getParams();
    //     $catalog = new Catalog($params['name_product'],$params['price'],$params['description']);
    //     (new CatalogRepository)->insert($catalog);
    //     header('Location: ' . $_SERVER['HTTP_REFERER']);
    // }

    public function actionSave()
    {
        $paramsRequest = (new Request())->getParams();
        $id = $paramsRequest['id'];

        if (isset($id)) {
            $catalog = new Catalog();
            $paramsKey = array_keys($paramsRequest);
            foreach ($paramsKey as $key) {
                $catalog->$key = $paramsRequest[$key];
            }
            (new CatalogRepository)->update($catalog);
        } else {
            $catalog = new Catalog($paramsRequest['name_product'], $paramsRequest['price'], $paramsRequest['description']);
            (new CatalogRepository)->insert($catalog);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function actionBuy()
    {
        $requset = (new Request())->getParams();
        $id = $requset['id'];

        $good = (new BasketRepository)->getOneProd($id);
        if ($good) {
            $good->basketUp();
        } else {
            $basket = new Basket(session_id(), $id, 1);
            (new BasketRepository)->insert($basket);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
