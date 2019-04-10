<?php

namespace app;

class Validator
{
    private $patternsArr = [
        "email" => '/^(\w{2,50}@\w{2,50}\.([A-Za-z]{2,4}))$/',
        "password" => '/^\w{8,50}$/',
        "name" => '/^\w{3,}$/',
        "house" => '/[^none]/',
        "preferences" => '/^\w{8,}$/'
    ];

    private $errorMsgs = [
        'email' => 'Email format must be arya@westeros.com',
        'password' => 'Password must contain minimum 8 word character (letter, number, underscore)',
        'name' => 'Name must contain minimum 8 word character (letter, number, underscore)',
        'house' => 'Select your great house',
        'preferences' => 'Preferences must contain minimum 8 word character (letter, number, underscore)'
    ];

    /*
     * @var Error
     */
    private $error;

    public function __construct(Error $error)
    {
        $this->error = $error;
    }

    public function validate($validateDataArr)
    {
        $result = true;

        foreach ($validateDataArr as $key => $value) {
            if (isset($this->patternsArr[$key])) {
                $isValidInput = preg_match(($this->patternsArr[$key]), $validateDataArr[$key]);

                if (!$isValidInput) {
                    $this->error->setError($key, $this->errorMsgs[$key]);
                }

                $result &= $isValidInput;
            }
        }

        return $result;
    }
}
