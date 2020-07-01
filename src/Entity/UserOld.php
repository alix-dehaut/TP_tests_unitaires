<?php

declare(strict_types=1);

namespace App\Entity;

use App\Service\EmailService;

class UserOld
{
    public $email;
    public $firstname;
    public $lastname;
    public $age;
    public $toDoList;

    public function __construct(string $email, string $firstname, string $lastname, int $age)
    {
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->toDoList;
    }

    public function isValid(): bool
    {
        return $this->checkMail() && $this->checkFirstname() && $this->checkLastname() && $this->checkAge();
    }

    public function checkMail()
    {
        if (isset($this->email) && filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function checkFirstname(): bool
    {
        return (isset($this->firstname) && strlen($this->firstname) > 0 ) ?? false;
    }

    public function checkLastname(): bool
    {
        return (isset($this->lastname) && strlen($this->lastname) > 0 ) ?? false;
    }

    public function checkAge(): bool
    {
        if (isset($this->age) && is_int($this->age) && $this->age >= 13){
            return true;
        }
        return false;
    }

    public function addToDoList()
    {
        if (isset($this->toDoList)) return false;
        $this->toDoList = new ToDoListOld($this, new EmailService());
        return true;
    }

}