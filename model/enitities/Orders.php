<?php

namespace app\model\enitities;

use app\model\Model;

class Orders extends Model
{
    protected $id;
    protected $id_user;
    protected $products;
    protected $sum_order;
    protected $user_name;
    protected $number;
    protected $email;
    protected $adress;
    protected $status;

    protected $prop = [
        'id_user' => false,
        'products' => false,
        'sum_order' => false,
        'user_name' => false,
        'number' => false,
        'email' => false,
        'adress' => false,
        'status' => false
    ];


    public function __construct($id_user = null, $products = null, $sum_order = null)
    {
        $this->id_user = $id_user;
        $this->products = $products;
        $this->sum_order = $sum_order;
    }
}
