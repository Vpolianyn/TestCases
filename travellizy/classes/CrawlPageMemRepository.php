<?php

/**
 * Page repository, mem-stored
 */
class CrawlPageMemRepository implements InterfaceCrawlPageRepository
{
    /**
     * Page entity list
     * @var array
     */
    protected $_pageList=[];


    /**
     * Add new page entity
     * @param CrawlEntity $page Page to add
     * @return boolean false if entity with same uri already exists
     */
    function addPage(CrawlEntity $page)
    {
        if ( $this->existByUri( $page->uri ) ) {
            return false;
        }
        $this->_pageList[$page->uri] = $page;
        return true;
    }

    /**
     * Check if page with uri exists
     * @param string $uri Uri to check
     * @return boolean true if entity with this uri exists in repo
     */
    function existByUri( $uri )
    {
        return array_key_exists($uri, $this->_pageList);
    }

    /**
     * Get full list of pages
     * @return array
     */
    function getAll()
    {
        return $this->_pageList;
    }

    /**
     * Get full list sorted by field
     * @param string  $field Field name to sort by
     * @param boolean $asc   Sort ascending
     * @return array List of pages sorted
     */
    function getAllSortBy($field,$asc)
    {
        uasort($this->_pageList, CrawlSort::compareBy($field,$asc));
        return $this->_pageList;
    }

    /**
     * Get count of pages stored
     * @return integer Count of pages
     */
    function size()
    {
        return count($this->_pageList);
    }
}
