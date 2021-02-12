<?php

use app\model\entities\Catalog;
use app\model\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase 
{
    public function testProduct() {
        $name = "Чай";
        $product = new Product($name);
        $this->assertEquals($name, $product->name);

    }
}
