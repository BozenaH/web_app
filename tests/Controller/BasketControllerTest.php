<?php
/**
 * Test class to check if we get exception if the balance is zero
 *
 */

namespace App\Tests\Controller;

use App\Controller\BasketController;
use Faker\Provider\Text;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BasketControllerTest extends WebTestCase
{
    /**
     * @expectException\Exception
     */

    public function testGetCreditBalanceExpectedException()
    {
        //Arrange

        $creditBalance = 0;
        $coursePrice = 10;
        $error = 'To low credit to buy this course';
        $expectedContent = mb_strtoupper($error);

        //Act
        $result = $creditBalance - $coursePrice;


        //Assert - Error -To low credit to buy this course
        $this->assertContains(
            $expectedContent, $error);
    }
}
