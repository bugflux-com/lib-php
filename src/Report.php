<?php


namespace Bugflux;


class Report
{
    public $project = 'Example application';
    public $version = '0.1.0';
    public $system = 'unknown';
    public $language = 'en_US';
    public $hash;
    public $name;
    public $environment = 'Production';
    public $stack_trace;
    public $message;
    public $client_id;

    /**
     * Report constructor.
     *
     * @param array $data See `fill` method.
     * @param \Exception $ex See `error` method.
     */
    public function __construct(\Exception $ex = null, array $data = [])
    {
        $this->client_id = sha1(php_uname());
        $this->system = php_uname('s') .' '. php_uname('r') .' '. php_uname('m');

        // Fill exception values
        if(!empty($ex)) {
            $this->error($ex);
        }

        // Override members using user values
        if(!empty($data)) {
            $this->fill($data);
        }
    }

    /**
     * Set values for class members.
     *
     * @param array $data Key-value, where key is member name.
     */
    public function fill(array $data)
    {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Set error-related properties.
     *
     * @param \Exception $ex
     */
    public function error(\Exception $ex)
    {
        $this->name = $ex->getMessage();
        $this->stack_trace = $ex->getTraceAsString();
        $this->hash = sha1(get_class($ex) . $ex->getFile());
    }
}