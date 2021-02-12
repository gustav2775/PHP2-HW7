<?php

namespace app\model\repositories;

use app\model\Repository;
use app\model\enitities\Feedback;

class FeedbackRepository extends Repository
{

    public  function getTableName()
    {
        return 'feedback';
    }
}
