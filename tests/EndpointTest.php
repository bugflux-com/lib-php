<?php


namespace Bugflux\Tests;


use Bugflux\Endpoint;
use Bugflux\Interfaces\RequestProvider;
use Bugflux\Report;

class EndpointTest extends \PHPUnit_Framework_TestCase
{
    public function testSend()
    {
        $url = 'https://bugflux.com/';
        $mockProvider = $this->getMockBuilder(RequestProvider::class)
            ->setMethods(['make'])
            ->getMock();

        $mockProvider->expects($this->once())
            ->method('make')
            ->with('post', $url);

        $endpoint = new Endpoint($mockProvider);
        $endpoint->url = $url;
        $endpoint->send(new Report());
    }
}