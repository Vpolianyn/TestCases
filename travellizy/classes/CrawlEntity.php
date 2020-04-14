<?php

class CrawlEntity
{
    public $uri;
    public $imageCount;
    public $time;

    function __construct($uri, $imageCount = null, $time = null)
    {
        $this->uri = $uri;
        $this->imageCount = $imageCount;
        $this->time = $time;
    }
}
