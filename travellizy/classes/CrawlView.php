<?php

class CrawlView
{
    private static $stepCount = 0;

    static function renderHelp( $scriptName )
    {
        echo "WebCrawler\n".
             "Usage:\n".
             "Test run (5 pages): php $scriptName <site-url> --test\n".
             "Normal run:         php $scriptName <site-url>\n";
    }

    static function renderStart( $rootUri, $isTest )
    {
        echo "Start crawling the '$rootUri' site.";
        if ( $isTest ) {
            echo " Test run (5 pages).";
        }
        echo "\n";
    }

    static function renderStep()
    {
        if ( self::$stepCount >= 50 ) {
            self::stepReset();
        }
        self::$stepCount++;
        echo '.';
    }

    static function stepReset()
    {
        echo "\n";
        self::$stepCount = 0;
    }

    static function renderPages( array $pageData )
    {
        self::stepReset();
        uasort( $pageData, CrawlSort::compareBy('imageCount', false));
        printf("| %4s | %10s | %s\n", 'Imgs', 'Time', 'Uri');
        foreach( $pageData as $uri => $data ) {
            printf("| %4d | %10.3f | %s\n", $data->imageCount, $data->time, $uri);
        }
        echo "Total: ".count($pageData)." pages processed.\n";
    }

    static function renderFileWritten( $fileName )
    {
        self::stepReset();
        echo "Data is written to file '$fileName'.\n";
    }
}
