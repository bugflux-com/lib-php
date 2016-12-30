<?php


namespace Bugflux;


class Request
{
    /**
     * @var Report
     */
    public $report;

    /**
     * @var Endpoint[]
     */
    public $endpoints = [];

    /**
     * Send report to random endpoint.
     *
     * @return bool
     */
    public function send()
    {
        shuffle($this->endpoints);
        foreach($this->endpoints as $name => $endpoint) {
            if($endpoint->send($this->report)) {
                return true;
            }
        }

        return false;
    }
}