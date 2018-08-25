<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BasketRepository")
 */
class Basket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    private $basket;

    /**
     * @return mixed
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * @param mixed $basket
     */
    public function setBasket($basket): void
    {
        $this->basket = $basket;
    }


}
