<?php

use Bugflux\Report;
use Bugflux\Request;

/**
 * Return static instance of Request class.
 * Shorthand for sending reports with defaults options.
 *
 * @param Exception|null $ex
 * @param array $data
 * @return Request
 */
function bugflux(\Exception $ex = null, array $data = [])
{
    static $request = null;

    // Create request for first method call
    if(is_null($request)) {
        $request = new Request();
        $request->report = new Report($ex, $data);
    }

    // Set report exception details
    if(!empty($ex)) {
        $request->report->error($ex);
    }

    // Set report custom data
    if(!empty($data)) {
        $request->report->fill($data);
    }

    return $request;
}