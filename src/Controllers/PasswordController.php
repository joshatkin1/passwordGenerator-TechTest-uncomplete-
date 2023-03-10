<?php

namespace Pixled\PasswordGenerator\Controllers;

use Illuminate\Http\Response;
use \Pixled\PasswordGenerator\Controllers\BaseController;
use Pixled\PasswordGenerator\Service\PasswordGenerator;

class PasswordController extends BaseController
{
    /**
     * This method is to be called within an application to return the genrated password
     *
     * @param int $length optional
     * @param bool $lowercase optional
     * @param bool $uppercase optional
     * @param int $numbers optional
     * @param int $special optional
     *
     * @return false|string
     */
    public function generatePassword(int $length = 10, bool $lowercase = true, bool $uppercase = true, int $numbers = 1, int $special = 1): false|string
    {
        try{
            $passwordGenerator = new PasswordGenerator(16 , true, true, 4, 4);
            return $passwordGenerator::generatePassword();
        }catch(\InvalidArgumentException $invalidArgumentException){
            //LOG to any relevant logs and return response
            return false;
        }
    }

    /**
     * This method is used for api calls to return the generated password
     *
     * @param int $length optional
     * @param bool $lowercase optional
     * @param bool $uppercase optional
     * @param int $numbers optional
     * @param int $special optional
     *
     * @return Response
     */
    public function generatePasswordApiCall(int $length = 10, bool $lowercase = true, bool $uppercase = true, int $numbers = 1, int $special = 1): Response
    {
        try {
            $password = $this->generatePassword($length, $lowercase, $uppercase, $numbers, $special);

            return $this->response->setContent($password);
        }catch (\InvalidArgumentException){
            return $this->response->status(500);
        }

    }
}
?>