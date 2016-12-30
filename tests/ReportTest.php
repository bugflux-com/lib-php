<?php


namespace Bugflux\Tests;


use Bugflux\Report;

class ReportTest extends \PHPUnit_Framework_TestCase
{
    public function testAttributes()
    {
        $this->assertClassHasAttribute('project', Report::class);
        $this->assertClassHasAttribute('version', Report::class);
        $this->assertClassHasAttribute('system', Report::class);
        $this->assertClassHasAttribute('language', Report::class);
        $this->assertClassHasAttribute('hash', Report::class);
        $this->assertClassHasAttribute('name', Report::class);
        $this->assertClassHasAttribute('environment', Report::class);
        $this->assertClassHasAttribute('stack_trace', Report::class);
        $this->assertClassHasAttribute('message', Report::class);
        $this->assertClassHasAttribute('client_id', Report::class);
    }

    public function testErrorMethod()
    {
        $report = new Report();
        $msg = "Example message";

        $report->error(new \Exception($msg));

        $this->assertEquals($msg, $report->name);
    }

    public function testFillMethod()
    {
        $report = new Report();
        $data = [
            'hash' => 'saf8Dm1l',
            'project' => 'Test Case',
        ];

        $report->fill($data);

        $this->assertEquals($data['hash'], $report->hash);
        $this->assertEquals($data['project'], $report->project);
    }

    public function testConstructor()
    {
        $ex = new \Exception("Example message");
        $data = [
            'project' => 'Test project',
            'hash' => '8aQ6maS',
        ];

        $report = new Report($ex, $data);

        $this->assertEquals($ex->getMessage(), $report->name);
        $this->assertEquals($data['project'], $report->project);
        $this->assertEquals($data['hash'], $report->hash);
    }
}