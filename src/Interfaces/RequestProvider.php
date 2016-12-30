<?php


namespace Bugflux\Interfaces;


interface RequestProvider
{
    /**
     * Send async request.
     *
     * @param $method
     * @param $url
     * @param $data
     * @param array $options
     * @return bool
     */
    public function make($method, $url, $data, array $options = []);
}