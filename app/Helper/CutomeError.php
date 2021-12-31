<?php

namespace App\Helper;

class CutomeError
{
    protected $errors = [];

    public function setError($name, $message)
    {

        $this->errors[$name][] = $message;
    }

    public function has_error($name)
    {
        return isset($this->errors[$name]) ? true : false;
    }
    public function count()
    {
        return count($this->errors);
    }

    public function firstItem($name)
    {
        return isset($this->errors[$name]) ? $this->errors[$name][0] : false;
    }
    public function __set($name, $value)
    {

        $this->setError($name, $value);
    }

    public function __get($name)
    {
        return $this->firstItem($name);
    }

    public function __isset($name)
    {
        return $this->has_error($name);
    }
}

// class CustomeError extends Error
// {
// }
// }