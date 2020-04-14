<?php

class CrawlPageParser implements InterfaceCrawlParser
{
    function getUriList( $html )
    {
        return CrawlExpr::getUriList($html);
    }

    function getImageCount( $html )
    {
        return count(CrawlExpr::getImageTagList($html));
    }
}
