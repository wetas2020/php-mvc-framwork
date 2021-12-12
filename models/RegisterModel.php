<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public string $firstname;
    public string $lastname;
    public string $password;
    public string $confirmPassword;
    public string $email;

    public function register()
    {
        echo "Creating new user...";
    }

}