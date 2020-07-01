<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Entity\UserOld;

class UserTest extends TestCase
{
    public function testIsValid()
    {
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
        $this->assertTrue($user->isValid());
    }

    public function testIsValidMustFailed()
    {
        $user = new UserOld('', 'alix', 'de Haut', 30);
        $this->assertFalse($user->isValid());
    }

    //MAIL
    public function testCheckMailOnEmpty()
    {
        $user = new UserOld('', 'alix', 'de Haut', 30);
        $this->assertFalse($user->checkMail());
    }

    public function testCheckMailOnWrongFormat()
    {
        $user = new UserOld('dehaut.alix@.com', 'alix', 'de Haut', 30);
        $this->assertFalse($user->checkMail());
    }

    public function testCheckMailOnGoodFormat()
    {
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
        $this->assertTrue($user->checkMail());
    }

    //FIRSTNAME
    public function testCheckFirstnameOnEmpty()
    {
        $user = new UserOld('dehaut.alix@gmail.com', '', 'de Haut', 30);
        $this->assertFalse($user->checkFirstname());
    }

    public function testCheckFirstname()
    {
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
        $this->assertTrue($user->checkFirstname());
    }

    //LASTNAME
    public function testCheckLastnameOnEmpty()
    {
        $user = new UserOld('dehaut.alix@gmail.com', '', '', 30);
        $this->assertFalse($user->checkLastname());
    }

    public function testCheckLastname()
    {
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
        $this->assertTrue($user->checkLastname());
    }

    //AGE
    public function testCheckAgeEqualThirthteen()
    {
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 13);
        $this->assertTrue($user->checkAge());
    }

    public function testCheckAgeLowerThanThirthteen()
    {
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 8);
        $this->assertFalse($user->checkAge());
    }

    public function testCheckAgeGreaterThanThirthteen()
    {
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
        $this->assertTrue($user->checkAge());
    }

    //TODOLIST
    public function testAddToDoListOnSuccess(){
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
        $this->assertTrue($user->addToDoList());
    }
    public function testAddToDoListOnFail(){
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
        $user->addToDoList();
        $this->assertFalse($user->addToDoList());
    }
}
