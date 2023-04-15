<?php
namespace App\Traits;

trait StrongPassword
{
    function generatePassword($length = 20) {
        // Define allowed characters
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[{]}\\|;:\'",<.>/?';

        // Get the total length of allowed characters
        $characterLength = strlen($characters);

        // Initialize the password variable
        $password = '';

        // Generate the password using a loop
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(1, $characterLength - 1)];
        }

        // Return the generated password
        return $password;
    }

}
