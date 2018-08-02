<?php
namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStudentData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $numStudents = 5;
        for ($i=0; $i < $numStudents; $i++)
        {
            $firstName = $faker->firstNameMale;
            $surname = $faker->lastName;
            $student = new Student();
            $student->setFirstName($firstName);
            $student->setSurname($surname);
            $manager->persist($student);
        }

        $manager->flush();

    }
}