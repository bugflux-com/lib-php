<?php


namespace Bugflux\Tests;


use Bugflux\Request;

class HelpersTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnClass()
    {
        $this->assertInstanceOf(Request::class, bugflux());
    }

    public function testArguments()
    {
        $msg = 'Exception message';
        $project = 'Test project';

        bugflux(new \Exception($msg), ['project' => $project]);

        $this->assertEquals($msg, bugflux()->report->name);
        $this->assertEquals($project, bugflux()->report->project);
    }
}