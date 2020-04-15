<?php

/**
 * Regular expression methods pool
 */
class CrawlExpr
{
    // uri validation expression
    const URI_EXPR = '/(https*:\/\/)?(\w+\.)+\w{2,}(\/\w+)*/';

    // root uri fetch expression
    const ROOT_URI_EXPR = '/((\w+\.)+\w{2,})(\/\w+)*/';

    // link tag parsing expression (uri fetch oriented)
    const HTML_LINK_EXPR = '/<a\s+.*?href=[\"\']((https*:\/\/)?(\/?(\w|[-.\/\\\\_&?=])*))[\"\'].*?>/';

    // image tag parsing expression (detection oriented)
    const IMG_TAG_EXPR = '/<img\s+.*?src=[\"\'].*?[\"\'].*?\/>/';


    /**
     * Check if it is uri
     * @param string $str String to validate
     * @returns boolean True if string is a valid site uri
     */
    static function isUri( $str )
    {
        return preg_match(self::URI_EXPR,$str);
    }

    /**
     * Fetch the root uri (hostname) from uri
     * @param string $uri Common uri
     * @returns string | null
     */
    static function getRootUri( $uri )
    {
        $matches = [];
        preg_match(self::ROOT_URI_EXPR, $uri, $matches);
        return @$matches[1];
    }

    /**
     * Get list of link uri-s from html text
     * @param string $html Html text
     * @returns array List of uri strings
     */
    static function getUriList( $html )
    {
        $matches = [];
        preg_match_all(self::HTML_LINK_EXPR, $html, $matches);
        return @$matches[3];
    }

    /**
     * Get list of image tags from html text
     * @param string $html Html text
     * @returns array List of strings with image tags
     */
    static function getImageTagList( $html )
    {
        $matches = [];
        preg_match_all(self::IMG_TAG_EXPR, $html, $matches);
        return @$matches[0];
    }
}
