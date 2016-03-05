<?php

namespace CSR;

/**
 * A single entry from a search engine, this way we can group all the results into one place for storage in database or other types of storage
 */
class Entry
{
    /**
     * The title of the entry
     *
     * @var
     */
    protected $title;

    /**
     * The URL of the entry in question
     *
     * @var
     */
    protected $url;

    /**
     * The position of the entry
     *
     * @var
     */
    protected $position = array();

    /**
     * The engines of the entries
     *
     * @var array
     */
    protected $engines = array();

    /**
     * Return all the positions
     *
     * @return array
     */
    public function getPositions()
    {
        return $this->position;
    }

    /**
     * Get the overall position of the entry
     *
     * @return mixed
     */
    public function getPosition()
    {
        return array_sum($this->position) / count($this->position);
    }

    /**
     * Get the Entry title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the Entry URL
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * All the engines that we found the results on
     *
     * @return array
     */
    public function getEngines()
    {
        return $this->engines;
    }


    /**
     * Process the entry
     *
     * @param $data All the data as an object so we can expand the data
     * @param $engine The engine of entry we need to process
     */
    public function update($data, $engine)
    {
        $this->url = $data['url'];
        $this->title = $data['title'];
        if (!in_array($engine, $this->engines)) {
            $this->position[$engine] = $data['position'];
            array_push($this->engines, $engine);
        }
    }
}