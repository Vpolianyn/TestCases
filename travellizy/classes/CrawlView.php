<?php

/**
 * Console renderer for crawler and pagelist
 */
class CrawlView
{
    /**
     * Counter of application steps
     * @var integer
     */
    private static $stepCount = 0;

    /**
     * Render application help text
     * @param string $scriptName Name of application script
     */
    static function renderHelp( $scriptName )
    {
        echo "WebCrawler\n".
             "Usage:\n".
             "Test run (5 pages): php $scriptName <site-url> --test\n".
             "Normal run:         php $scriptName <site-url>\n";
    }

    /**
     * Render the application start message
     * @param string  $rootUri Root uri of site to parse
     * @param boolean $isTest  Is test-mode on
     */
    static function renderStart( $rootUri, $isTest )
    {
        echo "Start crawling the '$rootUri' site.";
        if ( $isTest ) {
            echo " Test run (5 pages).";
        }
        echo "\n";
    }

    /**
     * Render one application step
     */
    static function renderStep()
    {
        if ( self::$stepCount >= 50 ) {
            self::stepReset();
        }
        self::$stepCount++;
        echo '.';
    }

    /**
     * End the step sequence (row)
     */
    static function stepReset()
    {
        echo "\n";
        self::$stepCount = 0;
    }

    /**
     * Render the page list as a table
     * @param array $pageData List of page entities
     */
    static function renderPages( array $pageData )
    {
        self::stepReset();
        printf("| %4s | %10s | %s\n", 'Imgs', 'Time', 'Uri');
        foreach( $pageData as $uri => $data ) {
            printf("| %4d | %10.3f | %s\n", $data->imageCount, $data->time, $uri);
        }
        echo "Total: ".count($pageData)." pages processed.\n";
    }

    /**
     * Render the message about the file report written
     * @param string $fileName Name of report file
     */
    static function renderFileWritten( $fileName )
    {
        self::stepReset();
        echo "Data is written to file '$fileName'.\n";
    }
}
