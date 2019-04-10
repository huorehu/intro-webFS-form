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
            $this->error['username-err'] = 'User with name ' . $username . ' already exists';
        }
    }

    private function isUserExists($input)
    {
        return array_key_exists($input, json_decode(file_get_contents($this->usersDataPath)));
    }

    private function isUsernameExists($username) {
        return array_search($this->getListValues('username'), $username) === true;
    }

    private function getListValues($value)
    {
        return array_column(array_values(json_decode(file_get_contents($this->usersDataPath), true)), $value);
    }

    private function addUserToList($email, $password)
    {
        $array_data = json_decode(file_get_contents($this->usersDataPath), true);
        $array_data[$email] = ['email' => $email, 'password' => $password];
        return (bool) file_put_contents($this->usersDataPath, json_encode($array_data, JSON_PRETTY_PRINT));
    }

    private function isValidPassword($email, $password) {
        $isAuthorized = json_decode(file_get_contents($this->usersDataPath), true)[$email]['password'] === $password;

        if ($isAuthorized) {
            return true;
        }

        $this->error->setError('authorize-err', 'Email and password don\'t match');

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
