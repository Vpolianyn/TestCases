<?php

/**
 *  Site processing class
 */
class Crawler
{
    /**
     * Initial uri for site to parse
     * @var string
     */
    protected $_initUri;

    /**
     * Page reader handler to get pages through
     * @var object
     */
    protected $_pageReader;

    /**
     * Page parser handler to analyse the pages
     * @var object
     */
    protected $_pageParser;



    /**
     * Repository of pages parsed
     * @var object
     */
    protected $_pageList;

    /**
     * Queue repository for pages to parse
     * @var 
     */
    protected $_pageQueue;


    /**
     * Initialize the crawler
     * @param string               $initialUri Site uri to parse
     * @param InterfaceCrawlReader $reader     Page reader handler
     * @param InterfaceCrawlParser $parser     Page parser handler
     */
    function __construct( $initialUri, InterfaceCrawlReader $reader, InterfaceCrawlParser $parser )
    {
        $this->_initUri = $initialUri;
        $this->_rootUri = CrawlExpr::getRootUri( $initialUri );
        $this->_pageReader = $reader;
        $this->_pageParser = $parser;
        $this->_initRepository();
    }

    /**
     * Initialize the page repositories
     */
    protected function _initRepository()
    {
        $this->_pageList = new CrawlPageMemRepository();
        $this->_pageQueue = new CrawlPageMemQueue();
        // make the root as first page to parse
        $this->_pageQueue->addPage(new CrawlEntity($this->_rootUri));
    }

    /**
     * Execute the site parsing
     * @param boolean $isTest If test-mode is on
     */
    function run( $isTest )
    {
        CrawlView::renderStart( $this->_rootUri, $isTest );
        $counter = 5;  // page count for test-mode
        do {
            // process each page from queue
            $entity = $this->_pageQueue->removeFirst();
            $this->_crawlPage($entity->uri);
            // test-mode early end condition
            if ( $isTest && --$counter <= 0 ) {
                break;
            }
        } while ( !$this->_pageQueue->isEmpty() );
    }

    /**
     * Return list of parsed page (sorted)
     * @return array List of page entities
     */
    function getPageData()
    {
        return $this->_pageList->getAllSortBy('imageCount',false);
    }

    /**
     * Process single page
     * @param string $uri Page uri
     */
    protected function _crawlPage( $uri )
    {
        CrawlView::renderStep();
        // fetch and parse the page
        $startTime = microtime(true);
        $html = $this->_pageReader->getHtml( $uri );
        $imgCount = $this->_pageParser->getImageCount( $html );
        $uriList = $this->_pageParser->getUriList( $html, $this->rootUri );
        $endTime = microtime(true);
        // add to processed list
        $this->_pageList->addPage( new CrawlEntity($uri,$imgCount,$endTime - $startTime) );
        // add internal uris found to queue
        foreach( $uriList as $newUri ) {
            // '/something' like uris are internals, '/' ignored
            if ( '/' == $newUri[0] && '/' != $newUri ) {
                $newUri = $this->_rootUri . $newUri;
            } else if ( 0 !== strpos($newUri, $this->_rootUri) ) {
                continue;
            }
            // check if uri already processed or in queue
            if ( !$this->_pageList->existByUri($newUri) &&
                    !$this->_pageQueue->existByUri($newUri) ) {
                $this->_pageQueue->addPage(new CrawlEntity($newUri));
            }
        }
    }
}
