<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StudentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Student::class);
    }
}
/**
    private $students = [];

    {
        $id = 1;
        $s1 = new Student($id, 'matt', 'smith');
        $this->students[$id] = $s1;

        $id = 2;
        $s2 = new Student($id, 'joelle', 'murphy');
        $this->students[$id] = $s2;

        $id = 3;
        $s3 = new Student($id, 'frances', 'mcguinness');
        $this->students[$id] = $s3;
    }
    public function findAll()
    {
    return $this->students;
    }

}




