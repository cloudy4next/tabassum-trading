<?php

namespace App\Exceptions;

use Exception;

class GlobalExecption extends Exception
{
    public function __construct($customMessage = null)
    {
        if (is_array($customMessage)) {
            $message = json_encode($customMessage);
        } else {
            $message = $customMessage ?? 'Resource not found';
        }

        parent::__construct($message, 404);
    }



    public function render($request)
    {
        return redirect()->back()->with('error', $this->getMessage());
    }
}
