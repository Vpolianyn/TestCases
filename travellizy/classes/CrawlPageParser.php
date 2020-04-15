<?php

/**
 * Parser of html page
 */
class CrawlPageParser implements InterfaceCrawlParser
{

    /**
     * Get the list of link-tag uri on page
     * @param string $html Html text
     * @return array List of uri strings
     */
    function getUriList( $html )
    {
        return CrawlExpr::getUriList($html);
    }

    /**
     * Get count of image tags on page
     * @param string $html Html text
     * @return integer Count of image tags
     */
    function getImageCount( $html )
    {
        return count(CrawlExpr::getImageTagList($html));
    }
}
