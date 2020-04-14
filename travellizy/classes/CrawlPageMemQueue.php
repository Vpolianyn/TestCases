<?php

class CrawlPageMemQueue extends CrawlPageMemRepository
{
    function removeFirst()
    {
        reset($this->_pageList);
        $page = current($this->_pageList);
        array_shift($this->_pageList);
        return $page;
    }

    function isEmpty()
    {
        return 0 === $this->size();
    }
}
