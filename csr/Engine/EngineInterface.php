<?php

namespace CSR\Engine;

use GuzzleHttp\Psr7\Request;

/**
 * Default functionality that all engines should implement, all the engines should inhert from this interface or extend from {@link Engine}
 *
 * @package CSR\Engine
 */
interface EngineInterface
{

    /**
     * Returns the engine name
     *
     * @return mixed
     */
    public function getEngineName();

    /**
     * Process the returned html data
     * Here we should do any preprocessing needed and then call {@link parse}
     *
     * @param $data
     *
     * @return mixed
     */
    public function process($data);

    /**
     * Get the search request for the query
     *
     * @param $query
     * @return Request
     */
    public function getSearchRequest($query);

    /**
     * Parses the data into an array that returns the information we need called from {@link process}
     *
     * @param $data
     *
     * @return array
     */
    public function parse($data);
}