<?php


namespace App\Entity;


use App\Service\EmailService;

class ToDoList
{
    public $items = [];
    public $lastCreationItem;
    public $user;
    private $emailService;

    public function __construct(User $user, EmailService $emailService)
    {
        $this->user = $user;
        $this->emailService = $emailService;
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;
        $this->lastCreationItem = $item->creationDate;
        return $item;
    }

    public function canAddItem(Item $item)
    {
        if ($this->isUnique($item) && $this->checkMaxSize() && $this->checkWaitingTime()){
            $this->emailService->send($this->user);
            return $this->addItem($item);
        }
        return null;
    }

    public function checkWaitingTime()
    {
        if (!isset($this->lastCreationItem)) return true;

        $now = new \DateTime('NOW');
        $interval = $now->getTimestamp() - $this->lastCreationItem->getTimestamp();
        $waitingTime = 30 * 60;
        return $interval >= $waitingTime;
    }

    public function isUnique(Item $newItem)
    {
        foreach ($this->items as $item){
            if ($item->name == $newItem->name){
                return false;
            }
        }
        return true;
    }

    public function checkMaxSize()
    {
        return (count($this->items) >= 0) && (count($this->items) <= 10);
    }

}