<?php

/**
 * Configuration parameters
 */
class CrawlConfig
{
    /**
     * List of parameters
     * @var array
     */
    private $__params = [];

    /**
     * Site uri to work with
     * @var string
     */
    private $__uri = null;

    /**
     * Test mode flag
     * @var boolean
     */
    private $__isTest = false;

    /**
     * Init and handle the console parameters
     * @param array $params
     */
    function __construct( array $params )
    {
        foreach( $params as $key => $value ) {
            // skip the script name
            if ( $key < 1 ) {
                continue;
            }
            // check for test flag
            if ( '--test' == $value ) {
                $this->__isTest = true;
                continue;
            }
            // check for site uri
            // if parameter list contains 2 or more site uri, the last will owerwrite others
            if ( CrawlExpr::isUri( $value ) ) {
                $this->__uri = $value;
            }
        }
    }

    /**
     * If test-mode flag is set
     * @return boolean
     */
    function isTest()
    {
        return $this->__isTest;
    }

    /**
     * If parameter list included site uri
     * @return boolean
     */
    function hasUri()
    {
        return null !== $this->__uri;
    }

    /**
     * Get the uri param
     * @return string | null
     */
    function getUri()
    {
        return $this->__uri;
    }
}
