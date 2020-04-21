<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Runner\Exception;

class EmailService
{

    public function send( User $user): bool
    {
        if($user->age < 18) {
            throw new Exception("Not old enough");
        } else {
            return true;
        }
    }

}