<?php

/**
 * Page queue, mem-stored
 */
class CrawlPageMemQueue extends CrawlPageMemRepository
{
    /**
     * Remove first element of queue
     * return CrawlEntity The element removed
     */
    function removeFirst()
    {
        reset($this->_pageList);
        $page = current($this->_pageList);
        array_shift($this->_pageList);
        return $page;
    }

    /**
     * If queue is empty
     * @return boolean true if queue is empty
     */
    function isEmpty()
    {
        return 0 === $this->size();
    }
}
