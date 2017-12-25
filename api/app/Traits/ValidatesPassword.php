<?php

namespace App\Traits;

use Hash;

trait ValidatesPassword
{
    /**
     * Validates password for update
     *
     * @param string $password
     * @return boolean
     */
    public function isPasswordValid($password)
    {
        return Hash::check($password, $this->password);
    }
}
