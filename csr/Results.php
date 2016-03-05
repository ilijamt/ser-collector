<?php

namespace CSR;

/**
 * A wrapper that holds and manipulates all the entries for all the engines
 */
class Results
{

    /**
     * All the results that we managed to find
     *
     * @var array
     */
    protected $results = array();

    /**
     * Update the entry based on the data we provide
     *
     * @param $data
     * @param $engine
     */
    public function upsert($data, $engine)
    {
        $hash = hash("sha1", $data['url']);

        if (!isset($this->results[$hash])) {
            $this->results[$hash] = new Entry();
        }

        $entry = &$this->results[$hash];
        $entry->update($data, $engine);

    }

    /**
     * Sorts all the entries based on the average position of an entry
     */
    public function sort()
    {
        usort($this->results, function ($a, $b) {
            $apos = $a->getPosition();
            $bpos = $b->getPosition();
            if ($apos == $bpos) {
                return 0;
            }
            return ($apos < $bpos) ? -1 : 1;
        });
    }

    /**
     * Fetch all the arrays
     *
     * @return array
     */
    public function get()
    {
        return $this->results;
    }

}