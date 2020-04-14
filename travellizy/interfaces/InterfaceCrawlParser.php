<?php

interface InterfaceCrawlParser
{
    function getUriList( $html );
    function getImageCount( $html );
}
