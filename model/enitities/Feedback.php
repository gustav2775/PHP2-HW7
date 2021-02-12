<?php

namespace app\model\enitities;

use app\model\Model;

class Feedback  extends Model
{
    protected $id;
    protected $name;
    protected $feedback;
    protected $datefeedback;
    protected $idmode;

    protected $prop = [
        'name' => false,
        'feedback' => false,
        'datefeedback' => false
    ];

    public function __construct($name = null, $feedback = null)
    {
        $this->name = $name;
        $this->feedback = $feedback;
    }
}
