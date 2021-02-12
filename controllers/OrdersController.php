<?php

namespace app\controllers;

use app\model\repositories\{BasketRepository, CatalogRepository, OrdersRepository, UsersRepository};
use app\model\enitities\{Orders, Basket};
use app\engine\Request;
use app\engine\Session;

class OrdersController extends Controller
{
    public function actionOrders()
    {
        $id = (new Session())->getSession()['id'];

        if (isset($id)) {
            $is_admin = (new UsersRepository)->getOne($id)->is_admin();
            if ($is_admin) {
                $orders = (new OrdersRepository)->getAll();
            } else {
                $orders = (new OrdersRepository)->getAll($id);
            }
        }

        echo $this->renderLayouts("orders", [
            "orders" => $orders
        ]);
    }

    public function actionOrder()
    {
        $id = (new Request())->getParams()['id'];
        $order = (new OrdersRepository)->getOne($id);
        $products = $order->getProduct($order);
        echo $this->renderLayouts("order", [
            "order" => $order,
            'products' => $products
        ]);
    }

    public function actionCreateOrder()
    {
        $sum_order = (new Request())->getParams()['sum_order'];
        $id_user = (new Session())->getSession()['id'];

        $basket = (new BasketRepository)->getBasket();
        $data_products = json_encode($basket);

        $order = new Orders($id_user, $data_products, $sum_order);
        (new OrdersRepository)->insert($order);
        header('location:/orders/order/?id='. $order->id);
    }
    
    public function actionCreate()
    {
        $params = (new Request())->getParams();
        $order = (new Orders);

        $order ->id = $params['id'];
        $order ->user_name = $params['user_name'];
        $order ->email = $params['email'];
        $order ->number = $params['number'];
        $order ->adress = $params['adress'];
        $order ->status = 'не оплачен';

        (new OrdersRepository)->update($order);
        (new BasketRepository)->deleteBasket();

        header('location:/orders/order/?id='. $order->id);
    }
    public function actionStatus()
    {
        $params = (new Request())->getParams();
        $order = (new Orders);
        $order ->id = $params['id'];
        $order ->status = $params['status'];

        (new OrdersRepository)->update($order);
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
