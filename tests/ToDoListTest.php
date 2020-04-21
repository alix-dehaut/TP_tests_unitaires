<?php

declare(strict_types=1);

use App\Entity\ToDoList;
use App\Entity\User;
use App\Entity\Item;
use App\Service\EmailService;
use PHPUnit\Framework\TestCase;

class ToDoListTest extends TestCase
{
    private $user;
    private $emailServiceMock;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->emailServiceMock = $this->createMock(EmailService::class);
        $this->emailServiceMock->method('send')->willReturn(true);
        $this->user = new User('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
    }

    private function todoList()
    {
        return new ToDoList($this->user, $this->emailServiceMock);
    }

    public function testAddUniqueItem()
    {
        $item = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTime());
        $toDoList = $this->todoList();
        $this->assertTrue($toDoList->isUnique($item));
    }

    public function testAddNonUniqueItem()
    {
        $item = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTime());
        $item2 = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTime());
        $toDoList = $this->todoList();
        $toDoList->canAddItem($item);
        $this->assertFalse($toDoList->isUnique($item2));
    }

    public function testCheckMaxSize()
    {
        $toDoList = $this->todoList();
        for ($i = 0 ; $i < 11; $i++){
            $toDoList->addItem(new Item('Item'.$i, 'Lorem ipsum dolor sit amet', new DateTime()));
        }
        $this->assertFalse($toDoList->checkMaxSize());
    }

    public function testCheckMinSize()
    {
        $toDoList = $this->todoList();
        $this->assertTrue($toDoList->checkMaxSize());
    }

    public function testCheckWaitingTimeOnSuccess()
    {
        $dateTime = new DateTime();
        $dateTime->modify('- 30 minutes');
        $toDoList = $this->todoList();
        $toDoList->addItem(new Item('Item', 'Lorem ipsum dolor sit amet', $dateTime));
        $this->assertTrue($toDoList->checkWaitingTime());
    }

    public function testCheckWaitingTimeOnFail()
    {
        $dateTime = new DateTime();
        $dateTime->modify('- 10 minutes');
        $toDoList = $this->todoList();
        $toDoList->addItem(new Item('Item', 'Lorem ipsum dolor sit amet', $dateTime));
        $this->assertFalse($toDoList->checkWaitingTime());
    }

    public function testCanAddItemReturnNull(){
        $toDoList = $this->todoList();
        $item = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTime());
        $item2 = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTime());
        $toDoList->canAddItem($item);
        $this->assertEquals(null, $toDoList->canAddItem($item2));
    }

    public function testCanAddItemOnSuccess(){
        $toDoList = $this->todoList();
        $item = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTime());
        $item2 = new Item('Item2', 'Lorem ipsum dolor sit amet', new DateTime());
        $toDoList->canAddItem($item);
        $this->assertEquals(null, $toDoList->canAddItem($item2));
    }

}
