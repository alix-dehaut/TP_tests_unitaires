<?php
declare(strict_types=1);

namespace App\Entity;


class ItemOld
{
    public $name;
    public $content;
    public $creationDate;

    public function __construct(string $name, string $content, \DateTime $creationDate)
    {
        $this->name = $name;
        $this->content = $content;
        $this->creationDate= $creationDate;
    }

    public function isValid(): bool
    {
        return (isset($this->name) && isset($this->content) && strlen($this->content) <= 1000 && isset($this->creationDate) ) ?? false;
    }

}