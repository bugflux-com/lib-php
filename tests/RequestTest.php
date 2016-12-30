<?php


namespace Bugflux\Tests;


use Bugflux\Endpoint;
use Bugflux\Report;
use Bugflux\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testEndpointSend()
    {
        $report = new Report(new \Exception('Test'));
        $endpoint = $this->getMockBuilder(Endpoint::class)
            ->setMethods(['send'])
            ->getMock();

        $endpoint->expects($this->once())
            ->method('send')
            ->with($report)
            ->willReturn(true);

        $request = new Request();
        $request->report = $report;

        $request->endpoints['test'] = $endpoint;
        $request->send();
    }

    public function testEmptyEndpointList()
    {
        $request = new Request();
        $res = $request->send();

        $this->assertFalse($res);
    }
}