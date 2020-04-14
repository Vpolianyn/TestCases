<?php

class CrawlExpr
{
    const URI_EXPR = '/(https*:\/\/)?(\w+\.)+\w{2,}(\/\w+)*/';
    const ROOT_URI_EXPR = '/((\w+\.)+\w{2,})(\/\w+)*/';
    const HTML_LINK_EXPR = '/<a\s+.*?href=[\"\']((https*:\/\/)?(\/?(\w|[-.\/\\\\_&?=])*))[\"\'].*?>/';
    const IMG_TAG_EXPR = '/<img\s+.*?src=[\"\'].*?[\"\'].*?\/>/';

    static function isUri( $str )
    {
        return preg_match(self::URI_EXPR,$str);
    }

    static function getRootUri( $uri )
    {
        $matches = [];
        preg_match(self::ROOT_URI_EXPR, $uri, $matches);
        return @$matches[1];
    }

    static function getUriList( $html )
    {
        $matches = [];
        preg_match_all(self::HTML_LINK_EXPR, $html, $matches);
        return @$matches[3];
    }

    static function getImageTagList( $html )
    {
        $matches = [];
        preg_match_all(self::IMG_TAG_EXPR, $html, $matches);
        return @$matches[0];
    }
}
