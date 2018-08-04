<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */

class Course
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @return mixed
     * @ORM\Column(type="string",length=100,unique=true)
     */
    private $title;
    /**
     * @return mixed
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @return mixed
     * @ORM\Column(type="string")
     */
    private $image;
    /**
     * @return mixed
     * @ORM\Column(type="float")
     */
    private $price;


      //Getters and Setters
    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setId($id)
    {
        $this->id=$id;
    }
    public function setTitle($title)
    {
        $this->title=$title;
    }
    public function setDescription($description)
    {
        $this->description=$description;
    }
    public function setPrice($price)
    {
        $this->price=$price;
    }



}