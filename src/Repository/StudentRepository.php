<?php

namespace App\Repository;

use App\Entity\Student;

class StudentRepository
{
    private $students = [];
    public function __construct()
    {
        $id = 1;
        $s1 = new Student($id, 'bo', 'smith');
        $this->students[$id] = $s1;

        $id = 2;
        $s2 = new Student($id, 'ba', 'will');
        $this->students[$id] = $s2;

        $id = 3;
        $s3 = new Student($id, 'ann', 'book');
        $this->students[$id] = $s3;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->students;
    }
}