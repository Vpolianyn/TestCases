<?php

class CrawlPageReader implements InterfaceCrawlReader
{
    function getHtml( $uri )
    {
        $request = curl_init($uri);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($request);
        return $result;
    }
}
