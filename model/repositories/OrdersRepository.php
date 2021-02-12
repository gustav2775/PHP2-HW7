<?php

namespace app\model\repositories;

use app\model\Repository;
use app\model\enitities\Orders;

class OrdersRepository extends Repository
{
    public  function getTableName()
    {
        return 'orders';
    }
    public function getProduct($order){
      return  json_decode($order->products,true);
    }
    
}
