<?php

namespace CSR;

use CSR\Engine\Wrapper;


/**
 * CSR (Content search response) is a wrapper that everyone can use simple to process a query and return all the
 * results in a simple way that can be presented to the requestor
 *
 * @package CSR
 */
class CSR
{

    /**
     * All the results
     * @var Results
     */
    protected $results;

    /**
     * The actual query we are handling
     * @var
     */
    protected $query;

    /**
     * The engine wrapper that is responsible for processing all the data through all available engines
     *
     * @var Wrapper
     */
    protected $engineWrappers;

    /**
     * CSR constructor.
     */
    public function __construct($query)
    {
        $this->query = $query;
        $this->results = new Results();
        $this->engineWrappers = new Wrapper();
    }

    /**
     * Process the query
     */
    public function query()
    {
        $responses = $this->engineWrappers->process($this->query);

        foreach ($responses as $engine => $response) {
            foreach ($response as $r) {
                $this->results->upsert($r, $engine);
            }
        }

        $this->results->sort();
    }

    /**
     * Get all the results so we can present them on the front end
     *
     * @return Results
     */
    public function getResults()
    {
        return $this->results->get();
    }


}