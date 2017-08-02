<?php
declare(strict_types=1);

namespace Citilink\ExpertSenderApi\Tests\Request;

use Citilink\ExpertSenderApi\Enum\HttpMethod;
use Citilink\ExpertSenderApi\Enum\SubscribersRequest\SubscribersGetOption;
use Citilink\ExpertSenderApi\Request\SubscribersGetRequest;
use PHPUnit\Framework\Assert;

class SubscribersGetRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testValidUsage()
    {
        $request = new SubscribersGetRequest('email@email.ru', SubscribersGetOption::SHORT());
        Assert::assertEquals('/Api/Subscribers', $request->getUri());
        Assert::assertEquals(['email' => 'email@email.ru', 'option' => 'Short'], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('', $request->toXml());

        $requestLong = new SubscribersGetRequest('email@email.ru', SubscribersGetOption::LONG());
        Assert::assertEquals(['email' => 'email@email.ru', 'option' => 'Long'], $requestLong->getQueryParams());

        $requestFull = new SubscribersGetRequest('email@email.ru', SubscribersGetOption::FULL());
        Assert::assertEquals(['email' => 'email@email.ru', 'option' => 'Full'], $requestFull->getQueryParams());

        $requestEventsHistory = new SubscribersGetRequest('email@email.ru', SubscribersGetOption::EVENTS_HISTORY());
        Assert::assertEquals(
            ['email' => 'email@email.ru', 'option' => 'EventsHistory'],
            $requestEventsHistory->getQueryParams()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowExceptionIfEmailIsEmpty()
    {
        new SubscribersGetRequest('', SubscribersGetOption::SHORT());
    }
}