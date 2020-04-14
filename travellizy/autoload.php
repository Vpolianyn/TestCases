<?php
function crawlAutoload($className)
{
    if ( 0 === strpos($className, 'Crawl') ) {
        require_once('classes/'.$className.'.php');
    } else if ( 0 === strpos($className, 'InterfaceCrawl') ) {
        require_once('interfaces/'.$className.'.php');
    }
};
spl_autoload_register('crawlAutoload');
