<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity=ToDoList::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $toDoList;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeImmutable $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getToDoList(): ?ToDoList
    {
        return $this->toDoList;
    }

    public function setToDoList(?ToDoList $toDoList): self
    {
        $this->toDoList = $toDoList;

        return $this;
    }
}
