<?php 

namespace App\Exceptions;

use \Exception;
use Throwable;

class InvalidPhoneNumberException extends Exception
{


    /**
     * InvalidPhoneNumberException construct
     */
    public function __construct($message = 'Check your number format and try again', $code = 0, Throwable $previous = null) 
    {
        parent::__construct($message, $code, $previous);
    }
}