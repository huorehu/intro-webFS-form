<?php

namespace app;

class Error
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function getErrors() : array
    {
        return $this->errors;
    }

    public function setError($name, $message)
    {
        $this->errors[$name] = $message;
    }
}
