<?php
/**
 * Test class to check if user controller works correctly with form fill in function
 */

namespace App\Tests\Controller;

use App\DataFixtures\AppFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function testUserFormSubmitValidData()
    {
        // Arrange
        $url = '/user/new';
        $httpMethod = 'GET';
        $client = static::createClient();


        //act- form + fill in data + submit
        $form['username'] = 'student1';
        $form['email'] = 'john_king@yahoo.com';
        $form['password'] = 'student';
        $expectedResultArray = ['student1','john_king@yahoo.com','student'];
        $buttonName = 'Save';

        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'student1' => $form['username'],
            'john_king@yahoo.com' => $form['email'],
            'student' => $form['password'],
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowercase = strtolower($content);

        // Assert
        $this->assertContains($expectedResultArray, $contentLowercase);

    }


        public function testLoginFormSubmitValidData()
        {
            // Arrange
            $url = '/login';
            $httpMethod = 'GET';
            $client = static::createClient();

            $form= $crawler->selectButton('Save')->form();

            $form['user_new[username]'] = 'student1';
            $form['user_new[plainPassword]'] = 'student';

            $crawler = $client->submit($form);

            $this->assertTrue($client->getResponse()->isRedirect());
            $client->followRedirect();
            $this->assertContains(['student1','student'],
                $client->getResponse()->getContent()
            );
        }




}