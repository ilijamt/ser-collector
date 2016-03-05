<?php

namespace CSR\Engine;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

/**
 * An abstract engine that we can use for all the defined engines to extend from
 *
 * @package CSR\Engine
 */
abstract class Engine implements EngineInterface
{
    /**
     * Process the returned html data
     * Here we should do any preprocessing needed and then call {@link parse}
     *
     * @param $data
     *
     * @return mixed
     */
    final public function process($data)
    {
        return $this->parse($data);
    }

}