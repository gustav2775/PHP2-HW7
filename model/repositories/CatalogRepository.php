<?php

namespace app\model\repositories;

use app\model\Repository;
use app\model\enitities\Catalog;

class CatalogRepository extends Repository
{

    public  function getTableName()
    {
        return 'catalog';
    }
}
