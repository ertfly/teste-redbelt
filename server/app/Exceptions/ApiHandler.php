<?php

namespace App\Exceptions;

use Exception;

class ApiHandler extends Exception
{
    const NONE = 1;
    const RETURN = 2;
    const LOGIN = 3;
    const TOKEN = 4;

    private $action = 1;
    public function __construct($message, $action = self::NONE)
    {
        parent::__construct($message);
        $this->action = $action;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function render($a=null, $b=null, $v=null)
    {
        throw $this;
    }
}
