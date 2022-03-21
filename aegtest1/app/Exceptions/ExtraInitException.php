<?php 

namespace App\Exceptions;

use \Exception;
use Throwable;

class ExtraInitException extends Exception
{


    /**
     * ExtraInitException construct
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null) 
    {
        parent::__construct($message, $code, $previous);
    }
}