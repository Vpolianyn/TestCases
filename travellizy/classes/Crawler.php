<?php

/**
 *  Site processing class
 */
class Crawler
{
    protected $_initUri;
    protected $_pageReader;
    protected $_pageParser;

    protected $_pageList;
    protected $_pageQueue;

    function __construct( $initialUri, InterfaceCrawlReader $reader, InterfaceCrawlParser $parser )
    {
        $this->_initUri = $initialUri;
        $this->_rootUri = CrawlExpr::getRootUri( $initialUri );
        $this->_pageReader = $reader;
        $this->_pageParser = $parser;
        $this->_initRepository();
    }

    protected function _initRepository()
    {
        $this->_pageList = new CrawlPageMemRepository();
        $this->_pageQueue = new CrawlPageMemQueue();
        $this->_pageQueue->addPage(new CrawlEntity($this->_rootUri));
    }

    function run( $isTest )
    {
        CrawlView::renderStart( $this->_rootUri, $isTest );
        $counter = 5;
        do {
            $entity = $this->_pageQueue->removeFirst();
            $this->_crawlPage($entity->uri);
            if ( $isTest && --$counter <= 0 ) {
                break;
            }
        } while ( !$this->_pageQueue->isEmpty() );
    }

    function getPageData()
    {
        return $this->_pageList->getAllSortBy('imageCount',false);
    }

    protected function _crawlPage( $uri )
    {
        CrawlView::renderStep();
        $startTime = microtime(true);
        $html = $this->_pageReader->getHtml( $uri );
        $imgCount = $this->_pageParser->getImageCount( $html );
        $uriList = $this->_pageParser->getUriList( $html, $this->rootUri );
        $endTime = microtime(true);
        $this->_pageList->addPage( new CrawlEntity($uri,$imgCount,$endTime - $startTime) );
        foreach( $uriList as $newUri ) {
            if ( '/' == $newUri[0] && '/' != $newUri ) {
                $newUri = $this->_rootUri . $newUri;
            } else if ( 0 !== strpos($newUri, $this->_rootUri) ) {
                continue;
            }
            if ( !$this->_pageList->existByUri($newUri) &&
                    !$this->_pageQueue->existByUri($newUri) ) {
                $this->_pageQueue->addPage(new CrawlEntity($newUri));
            }
        }
    }
}
