<?php

namespace app;

class Register
{

    private $usersDataPath;

    private $error;

    public function __construct($usersDataPath, Error $error)
    {
        $this->usersDataPath = $usersDataPath;
        $this->error = $error;
    }

    public function register($email, $password)
    {
        if (!$this->isUserExists($email)) {
            return $this->addUserToList($email, $password);
        } else {
            return $this->isValidPassword($email, $password);
        }
    }

    public function saveData($email, $username, $house, $preferences)
    {
        if (!$this->isUsernameExists($username)) {
            return $this->addUserData($email, $username, $house, $preferences);
        } else {
            $this->error['username-error'] = 'User with name ' . $username . ' already exists';
        }
    }

    private function isUserExists($input)
    {
        return array_key_exists($input, json_decode(file_get_contents($this->usersDataPath)));
    }

    private function isUsernameExists($username) {
        $tmp = array_search($this->getListValues('username'), $username) === true;
        return $tmp;
    }

    private function getListValues($value)
    {
        $userData = json_decode(file_get_contents($this->usersDataPath), true);
        $tmpFirst = array_values($userData);
        $tmp = array_column(array_values(json_decode(file_get_contents($this->usersDataPath))), $value);
        return $tmp;
    }

    private function addUserToList($email, $password)
    {
        $array_data = json_decode(file_get_contents($this->usersDataPath), true);
        $array_data[$email] = ['email' => $email, 'password' => $password];
        return (bool) file_put_contents($this->usersDataPath, json_encode($array_data, JSON_PRETTY_PRINT));
    }

    private function isValidPassword($email, $password) {
        $arrayData = json_decode(file_get_contents($this->usersDataPath), true);
        $isAuthorized = $arrayData[$email]['password'] === $password;

        if ($isAuthorized) {
            return true;
        }

        $this->error->setError('authorize-error', 'Email and password not match');

        return false;
    }

    private function addUserData($email, $username, $house, $preferences)
    {
        $usersArray = json_decode(file_get_contents($this->usersDataPath), true);

        $usersArray[$email]['username'] = $username;
        $usersArray[$email]['personal-house'] = $house;
        $usersArray[$email]['preferences'] = $preferences;

        return (bool) file_put_contents($this->usersDataPath, json_encode($usersArray, JSON_PRETTY_PRINT));
    }
}
