<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
    /**
     * courses associated with basket
     * @ORM\OneToMany(targetEntity="App\Entity\Course", mappedBy="basket")
     */
    private $courses;//include an attribute to the basket object that allows a relationship of many courses to one
    //basket

    /**
     * constructor method
     * Category constructor.
     */
    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

}
