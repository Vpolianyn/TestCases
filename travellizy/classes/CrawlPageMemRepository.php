<?php

class CrawlPageMemRepository implements InterfaceCrawlPageRepository
{
    protected $_pageList=[];

    function addPage(CrawlEntity $page)
    {
        if ( $this->existByUri( $page->uri ) ) {
            return false;
        }
        $this->_pageList[$page->uri] = $page;
        return true;
    }

    function existByUri( $uri )
    {
        return array_key_exists($uri, $this->_pageList);
    }

    function getAll()
    {
        return $this->_pageList;
    }

    function getAllSortBy($field,$asc)
    {
        uasort($this->_pageList, CrawlSort::compareBy($field,$asc));
        return $this->_pageList;
    }

    function size()
    {
        return count($this->_pageList);
    }
}
