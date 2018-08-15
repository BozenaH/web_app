<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct (UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadCourses($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('student1');
        $user1->setFullName('John King');
        $user1->setEmail('john_king@yahoo.com');
        $user1->setCreditBalance(100);
        $user1->setPaidCourses('This is Java');
        $user1->setNotes('i have paid 15 euro for this course');
        $user1->setRoles(array('ROLE_USER'));
        $user1->setPassword(
            $this->passwordEncoder->encodePassword(
                $user1,
                'student'
            )
        );
        $user2 = new User();
        $user2->setUsername('student2');
        $user2->setFullName('Sarah Hall');
        $user2->setEmail('sarah_hall@yahoo.com');
        $user2->setCreditBalance(90);
        $user2->setPaidCourses('This is Html');
        $user2->setNotes('i have paid 10 euro for this course');
        $user2->setRoles(array('ROLE_USER'));
        $user2->setPassword(
            $this->passwordEncoder->encodePassword(
                $user2,
                'student'
            )
        );
        $user3 = new User();
        $user3->setUsername('student3');
        $user3->setFullName('Henry Bell');
        $user3->setEmail('Henry_Bell@yahoo.com');
        $user3->setCreditBalance(85);
        $user3->setPaidCourses('This is sql');
        $user3->setNotes('i have paid 15 euro for this course');
        $user3->setRoles(array('ROLE_USER'));
        $user3->setPassword(
            $this->passwordEncoder->encodePassword(
                $user3,
                'student'
            )
        );
        $user4 = new User();
        $user4->setUsername('staff');
        $user4->setFullName('Tom Cruse');
        $user4->setEmail('Tom_Cruse@yahoo.com');
        $user4->setCreditBalance(0);
        $user4->setPaidCourses(0);
        $user4->setNotes('none');
        $user4->setRoles(array('ROLE_ADMIN'));
        $user4->setPassword(
            $this->passwordEncoder->encodePassword(
                $user4,
                'staff'
            )
        );
        $user5 = new User();
        $user5->setUsername('admin');
        $user5->setFullName('Jack Rich');
        $user5->setEmail('Jack_Rich@yahoo.com');
        $user5->setCreditBalance(0);
        $user5->setPaidCourses(0);
        $user5->setNotes('none');
        $user5->setRoles(array('ROLE_SUPER_ADMIN'));
        $user5->setPassword(
            $this->passwordEncoder->encodePassword(
                $user5,
                'admin'
            )
        );
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->persist($user5);
        $manager->flush();
    }
    private function loadCourses(ObjectManager $manager)
    {
        $course1 = new Course();
        $course1->setTitle('This is Java');
        $course1->setDescription('this course is for beginners. you will learn java from basis');
        $course1->setImage('.pgp');
        $course1->setPrice(15);

        $course2 = new Course();
        $course2->setTitle('This is Html');
        $course2->setDescription('this course is for beginners. you will learn Html from basis');
        $course2->setImage('.pgp');
        $course2->setPrice(10);

        $course3 = new Course();
        $course3->setTitle('This is Sql');
        $course3->setDescription('this course is for beginners. you will learn Sql from basis');
        $course3->setImage('.pgp');
        $course3->setPrice(15);

        $manager->persist($course1);
        $manager->persist($course2);
        $manager->persist($course3);
        $manager->flush();
    }
}