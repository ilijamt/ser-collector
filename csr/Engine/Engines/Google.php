<?php

namespace CSR\Engine\Engines;

use CSR\Engine\Engine;
use GuzzleHttp\Psr7\Request;

/**
 * Google search engine parser
 *
 * @package CSR\Engine\Engines
 */
class Google extends Engine
{

    /**
     * Gets all the natural queries in the html page
     */
    const NATURAL_QUERY = "//div[@id = 'ires']/descendant::*[self::div or self::li][@class='g']";

    /**
     * Get natural link (<a> tag) in the natural node context
     */
    const NATURAL_LINKS_IN = "descendant::h3[@class='r'][1]/a";

    /**
     * Returns the engine name
     *
     * @return mixed
     */
    public function getEngineName()
    {
        return "Google";
    }

    /**
     * Parses the data into an array that returns the information we need called from {@link process}
     *
     * @param $data
     *
     * @return array
     */
    public function parse($data)
    {

        $naturals = array();
        $results = array();

        libxml_use_internal_errors(TRUE);

        $dom = new \DOMDocument();
        $dom->encoding = "utf-8";
        $dom->loadHTML($data);
        $xpath = new \DOMXPath($dom);

        $naturals = $xpath->query(self::NATURAL_QUERY);

        foreach ($naturals as $idx => $node) {

            $tag = $xpath->query(self::NATURAL_LINKS_IN, $node);
            $tag = $tag->item(0);

            if (!$tag) {
                continue;
            }

            $title = $tag->nodeValue;
            $position = $idx + 1;
            $url = $tag->getAttribute("href");

            $hasProtocol = strpos($url, "://") > 0;

            if ($hasProtocol) {
                $url = str_replace("/url?q=", "", $url);
                $pos = mb_strpos($url, "&sa=");
                $url = substr($url, 0, $pos);
            } else {
                $url = "https://google.com$url";
            }

            $results[] = array('title' => $title, "url" => $url, "position" => $position);
        }

        libxml_use_internal_errors(FALSE);
        libxml_clear_errors();

        return $results;
    }


    /**
     * Get the search URL for the query
     *
     * @param $query
     * @return mixed
     */
    public function getSearchRequest($query)
    {
        $params = array("q=" . urlencode($query), "start=0", "complete=0", "pws=0", "hl=en", "lr=lang_en");
        return new Request("GET", "https://www.google.com/search?" . join("&", $params));
    }

}