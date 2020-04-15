<?php

/**
 * Sort method generator for entity
 */
class CrawlSort
{

    /**
     * Get sort method by field for usort() like functions
     * @param string  $fieldName Name of field to sort by
     * @param boolean $asc       Sort ascending
     * @return function Sort method
     */
    static function compareBy( $fieldName, $asc ) {
        if ( $asc ) {
            return function( $pageA, $pageB ) use ($fieldName)
                {
                     if ($pageA->$fieldName > $pageB->$fieldName) {
                         return 1;
                     } else if ($pageA->$fieldName < $pageB->$fieldName) {
                         return -1;
                     }
                     return 0;
                };
        } else {
            return function( $pageA, $pageB ) use ($fieldName)
                {
                     if ($pageA->$fieldName < $pageB->$fieldName) {
                         return 1;
                     } else if ($pageA->$fieldName > $pageB->$fieldName) {
                         return -1;
                     }
                     return 0;
                };
        }
    }
}
