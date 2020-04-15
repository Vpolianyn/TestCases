<?php

/**
 * Page entity to crawl
 */
class CrawlEntity
{
   /**
    * Page uri
    * @var string
    */
    public $uri;

   /**
    * Count of image tags on page
    * @var integer
    */
    public $imageCount;

   /**
    * Time of page handling (seconds)
    * @var float
    */
    public $time;

   /**
    * Create new page entity
    * @param string  $uri        Page uri
    * @param interer $imageCount Image tags count
    * @param float   $time       Time the page handled in
    */
    function __construct($uri, $imageCount = null, $time = null)
    {
        $this->uri = $uri;
        $this->imageCount = $imageCount;
        $this->time = $time;
    }
}
