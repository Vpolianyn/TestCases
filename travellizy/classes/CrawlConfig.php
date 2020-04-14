<?php

class CrawlConfig
{
    private $__params = [];
    private $__uri = null;
    private $__isTest = false;

    function __construct( array $params )
    {
        foreach( $params as $key => $value ) {
            if ( $key < 1 ) {
                continue;
            }
            if ( '--test' == $value ) {
                $this->__isTest = true;
                continue;
            }
            if ( CrawlExpr::isUri( $value ) ) {
                $this->__uri = $value;
            }
        }
    }

    function isTest()
    {
        return $this->__isTest;
    }

    function hasUri()
    {
        return null !== $this->__uri;
    }

    function getUri()
    {
        return $this->__uri;
    }
}
