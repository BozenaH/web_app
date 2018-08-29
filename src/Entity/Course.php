<?php
/**
 * File for Course entity
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * Class for Course entity variables with getter and setter methods
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */

class Course
{
    /**
     * primary key variable
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * title variable
     * @return mixed
     * @ORM\Column(type="string",length=100,unique=true)
     */
    private $title;
    /**
     * description variable
     * @return mixed
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * image variable
    *@ORM\Column(type="string")
    * @Assert\NotBlank(message="Please, upload the product image as a png/jpeg file.")
    * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
    */
    private $image;

    /**
     * price variable
    * @return mixed
    * @ORM\Column(type="float")
    */
    private $price;

    /**
     * getter method for id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * getter method
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * getter method
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * getter method
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * getter method
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * setter method
     * @param $id
     */
    public function setId($id)
    {
        $this->id=$id;
    }

    /**
     * setter method
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title=$title;
    }

    /**
     * setter method
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description=$description;
    }

    /**
     * setter method
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * setter method
     * @param $price
     */
        public function setPrice($price)
    {
        $this->price=$price;
    }

    /**
     * method to string for form builder that needs a string for each image in its list to display
     * @return string
     *
     */
    public function __toString()
    {
        return $this->id . ': ' . $this->getImage();
    }
    /**
     * courses associated to basket , many courses could be i a basket
     * @ORM\ManyToOne(targetEntity="App\Entity\Basket", inversedBy="courses")
     * @ORM\JoinColumn(nullable=true)
     */


}