<?php

class CrawlHtmlFileWriter
{
    protected static $file;

    static function getFileName()
    {
        return 'report_'.date('d.m.Y').'.html';
    }

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

    protected static function renderHeader( $siteName )
    {
        fwrite( self::$file,
                '<html><head><title>Report '.date('d.m.Y').' '.$siteName."</title></head><body>\n".
                "<table><thead><th>Uri</th><th>Image count</th><th>Time (sec)</th></thead>\n" );
    }

    protected static function renderFooter( $totalCount )
    {
        fwrite( self::$file, '<tr><td colspan="3">Total pages: '.$totalCount."</td></tr>\n".
                             '</table></body></html>' );
    }

    protected static function renderRow(CrawlEntity $page )
    {
        fwrite( self::$file, '<tr><td><a href="'.$page->uri.'">'.$page->uri.'</a></td><td>'.$page->imageCount.'</td><td>'.$page->time."</td></tr>\n" );
    }
}
