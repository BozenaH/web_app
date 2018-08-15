<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $fullName;

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $paidCourses;
    /**
     * @return mixed
     */
    public function getPaidCourses()
    {
        return $this->paidCourses;
    }

    /**
     * @param mixed $paidCourses
     */
    public function setPaidCourses($paidCourses): void
    {
        $this->paidCourses = $paidCourses;
    }

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $notes;

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes): void
    {
        $this->notes = $notes;
    }


    /**
     * @ORM\Column(type="integer")
     */
    private $creditBalance;

    /**
     * @return mixed
     */
    public function getCreditBalance()
    {
        return $this->creditBalance;
    }

    /**
     * @param mixed $creditBalance
     */
    public function setCreditBalance($creditBalance): void
    {
        $this->creditBalance = $creditBalance;
    }

    /**
     * user roles array
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    public function getRoles()
    {
        $roles = $this->roles;
        // ensure always contains ROLE_USER
          // $roles[] = 'ROLE_USER';
        return $roles;
    }
        /**
        * setter method
        * @param $roles
        * @return $this
        */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null; // no salt needed as bcrypt is used
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list($this->id,
            $this->username,
            $this->password) = unserialize($serialized);
    }



}
