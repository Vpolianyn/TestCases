<?php
require_once('autoload.php');

$config = new CrawlConfig($argv);

if ( $config->hasUri() ) {
    // crawl
    $reader = new CrawlPageReader();
    $parser = new CrawlPageParser();
    $crawler = new Crawler( $config->getUri(), $reader, $parser );
    $crawler->run( $config->isTest() );
//    if ( $config->isTest() ) {
//        CrawlView::renderPages( $crawler->getPageData() );
//    } else {
        $fileName = CrawlHtmlFileWriter::renderPages( $crawler->getPageData(), $config->getUri() );
        CrawlView::renderFileWritten( $fileName );
//    }
} else {
    // display help
    CrawlView::renderHelp($argv[0]);
}

exit(0);

?>
