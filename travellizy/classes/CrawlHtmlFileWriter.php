<?php

/**
 * Output handler for rendering the page list report to html file
 */
class CrawlHtmlFileWriter
{
    /**
     * File handler to wtite to
     * @var resource
     */
    protected static $file;

    /**
     * Generate the report file name
     * @return string Filename
     */
    static function getFileName()
    {
        return 'report_'.date('d.m.Y').'.html';
    }

    /**
     * Render the page list
     * @param array  $pageData List of page entities
     * @param string $siteName Site name for header
     * @return string Name of file written to
     */
    static function renderPages( array $pageData, $siteName )
    {
        $fileName = self::getFileName();
        self::$file = fopen( $fileName, 'w' );
        self::renderHeader( $siteName );
        foreach( $pageData as $data ) {
            self::renderRow( $data );
        }
        self::renderFooter( count($pageData) );
        fclose( self::$file );
        return $fileName;
    }

    /**
     * Write the file header
     * @param string $siteName Site name
     */
    protected static function renderHeader( $siteName )
    {
        fwrite( self::$file,
                '<html><head><title>Report '.date('d.m.Y').' '.$siteName."</title></head><body>\n".
                "<table><thead><th>Uri</th><th>Image count</th><th>Time (sec)</th></thead>\n" );
    }

    /**
     * Write the file footer
     * @param integer $totalCount Count of rows
     */
    protected static function renderFooter( $totalCount )
    {
        fwrite( self::$file, '<tr><td colspan="3">Total pages: '.$totalCount."</td></tr>\n".
                             '</table></body></html>' );
    }

    /**
     * Write the list row
     * @param CrawlEntity $page Page entity to render
     */
    protected static function renderRow(CrawlEntity $page )
    {
        fwrite( self::$file, '<tr><td><a href="'.$page->uri.'">'.$page->uri.'</a></td><td>'.$page->imageCount.'</td><td>'.$page->time."</td></tr>\n" );
    }
}
