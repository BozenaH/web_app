<?php
/**
 * test class to check if default controller works correctly
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepageResponseCodeOkay()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();

        // Assert
        $client->request($httpMethod, $url);

        // Assert
        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testHomepageContentContainsWelcome()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Welcome to e-learning courses.';

        // Act
        $client->request($httpMethod, $url);

        // Assert
        $this->assertContains(
            $searchText,
            $client->getResponse()->getContent()
        );
    }

    public function testHomepageHasLinkToLoginPage()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $expectedContent = 'Username';
        $expectedContentLowercase = strtolower($expectedContent);

        //special object that can crawl and navigate through the content to do things with the request
        //here we request homepage with url we indicated above
        $crawler = $client->request($httpMethod,$url);

        //find and click link
        //name of the link is login
        $linkText = 'login';
        $link = $crawler->selectLink($linkText)->link();

        //we click the link
        $client->click($link);

        //assert
        //we get response and get content of this page we were directed to
        //and look for username
        $resultContent = $client->getResponse()->getContent();
        $resultContentLowercase = strtolower($resultContent);

        // Act
        $this->assertContains(
            $expectedContentLowercase, $resultContentLowercase);

    }

}