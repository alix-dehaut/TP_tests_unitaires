<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\UserOld;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Runner\Exception;

class EmailService
{

    public function send(UserOld $user): bool
    {
        if($user->age < 18) {
            throw new Exception("Not old enough");
        } else {
            return true;
        }
    }

}