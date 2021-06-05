<?php

namespace App\Exceptions\HttpExceptions;



class UnprocessibleEntityException extends \Exception
{
    public function render($request)
    {
        return back()->withErrors(
            json_decode((string) $this->message, TRUE)["errors"]
        );
    }
}
