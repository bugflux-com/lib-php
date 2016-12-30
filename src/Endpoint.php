<?php


namespace Bugflux;


use Bugflux\Interfaces\RequestProvider;
use Bugflux\Wrappers\GuzzleWrapper;

class Endpoint
{
    /**
     * Endpoint full address.
     *
     * @var string
     */
    public $url;

    /**
     * Endpoint options:
     * verify - force to use verified certificates.
     *
     * @var array
     */
    public $options = [
        'verify' => true,
    ];

    /**
     * @var RequestProvider
     */
    private $requestProvider;

    /**
     * Endpoint constructor.
     *
     * @param RequestProvider $requestProvider
     */
    public function __construct(RequestProvider $requestProvider = null)
    {
        $this->requestProvider = $requestProvider ?: new GuzzleWrapper();
    }

    /**
     * Send report.
     *
     * @param Report $report
     * @return bool True if success, false otherwise (error or timeout).
     */
    public function send(Report $report)
    {
        $data = json_encode($report);

        return $this->requestProvider->make('post', $this->url, $data, $this->options);
    }
}