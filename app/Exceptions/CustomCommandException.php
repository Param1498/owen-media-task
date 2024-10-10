<?php

namespace App\Exceptions;

use Exception;

class CustomCommandException extends Exception
{
    // Add custom properties if necessary
    protected $customMessage;

    public function __construct($message = "Custom Command Error", $code = 0, Exception $previous = null)
    {
        // Custom logic can be added here
        $this->customMessage = $message;
        parent::__construct($message, $code, $previous);
    }

    // Optionally, add a custom string representation of the exception
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
