<?php
/**
 * File for User entity
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Class for User entity variables with getter and setter methods
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_ADMIN';
    /**
     * primary key variable
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * getter method
     * @return mixed
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * username variable
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $username;

    /**
     * password variable
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * email variable
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private $email;

    /**
     * getter method
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * setter method
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * full name variable
     * @ORM\Column(type="string", length=50)
     */
    private $fullName;

    /**
     * getter method
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * setter method
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * paid courses variable
     * @ORM\Column(type="array")
     */
    private $paidCourses;

    /**
     * getter method
     * @return mixed
     */
    public function getPaidCourses()
    {
        return $this->paidCourses;
    }

    /**
     * setter method
     * @param mixed $paidCourses
     */
    public function setPaidCourses($paidCourses): void
    {
        if (count($paidCourses) == 1 && $paidCourses[0] == null) {
            return;
        }
        $this->paidCourses = $paidCourses;
    }

    /**
     * notes variable
     * @ORM\Column(type="string", length=50)
     */
    private $notes;

    /**
     * getter method
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * setter method
     * @param mixed $notes
     */
    public function setNotes($notes): void
    {
        $this->notes = $notes;
    }


    /**
     * credit balance variable
     * @ORM\Column(type="integer")
     */
    private $creditBalance;

    /**
     * getter method
     * @return mixed
     */
    public function getCreditBalance()
    {
        return $this->creditBalance;
    }

    /**
     * setter method
     * @param mixed $creditBalance
     */
    public function setCreditBalance($creditBalance): void
    {
        //we need to ensure creditBalance is not overwritten with null
        //while the user is being edited and we don't provide credit info
        if ($creditBalance !== null) {
            $this->creditBalance = $creditBalance;
        }
    }

    /**
     * user roles array
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * getter method
     * @return array
     */
    public function getRoles()
    {
        $roles = $this->roles;
        //$roles[] = 'ROLE_USER';
        // ensure always contains ROLE_USER
        return $roles;

    }

    /**
     * setter method
     * @param $roles
     * @return $this
     */
    public function setRoles($roles)
    {
        //ensure role is not overwritten with null
        //while we edit user and don't provide this info
        //so current role is role
        if (!empty($roles)) {
            $this->roles = $roles;
        }
        return $this;
    }

    /**
     * * getter method
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * getter method
     * @return null|string
     */
    public function getSalt()
    {
        return null; // no salt needed as bcrypt is used
    }

    /**
     * getter method
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * setter method
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * setter method
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        // ensure not to overwrite password with null
        //if password is not null then password is $password
        if ($password !== null) {
            $this->password = $password;
        }
    }

    /**
     * erase credentials method not used here
     */
    public function eraseCredentials()
    {

    }

    /**
     * special method
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,

        ]);
    }

    /**
     * special method for converting to byte-stream
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list($this->id,
            $this->username,
            $this->password) = unserialize($serialized);
    }


}
