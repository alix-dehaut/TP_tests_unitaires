<?php

declare(strict_types=1);

use App\Entity\ItemOld;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testItemOnNotValidContent()
    {
        $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend justo fermentum, 
        iaculis erat vel, dictum felis. Nam metus arcu, varius ut congue in, commodo eu nunc. Integer semper sem neque, 
        viverra lobortis quam tempor et. Pellentesque feugiat dapibus arcu maximus suscipit. Nunc eleifend ligula eu 
        sapien sollicitudin, a ultrices elit tincidunt. Nam nec lacinia nulla, ut semper magna. Nulla et laoreet turpis, 
        vel ultrices ex. Mauris in facilisis dolor. Donec mollis placerat purus vitae tincidunt. Pellentesque habitant morbi 
        tristique senectus et netus et malesuada fames ac turpis egestas. Sed id scelerisque turpis. Suspendisse dolor quam, 
        dapibus sed ligula porttitor, convallis tincidunt quam. Pellentesque purus neque, fermentum vel malesuada vitae, 
        fermentum eget lacus. Proin blandit at mauris sed suscipit. Ut consectetur, elit ac molestie pretium, ipsum felis 
        rutrum elit, ut congue metus metus in purus. Curabitur ultrices lacus non orci sagittis rutrum. Quisque eget sem nullam.';
        $item = new ItemOld('Item', $content, new DateTime());
        $this->assertFalse($item->isValid());
    }

    public function testItemOnValidContent()
    {
        $item = new ItemOld('Item', 'Lorem ipsum dolor sit amet', new DateTime());
        $this->assertTrue($item->isValid());
    }

}
