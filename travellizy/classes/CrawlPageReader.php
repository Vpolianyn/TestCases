<?php

/**
 * Site pages read handler, curl-based
 */
class CrawlPageReader implements InterfaceCrawlReader
{

    /**
     * Get html text of page by uri
     * @param string $uri Uri to get page by
     * @return string Html text
     */
    function getHtml( $uri )
    {
        $request = curl_init($uri);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($request);
        return $result;
    }
}
