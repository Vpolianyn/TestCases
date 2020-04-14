<?php

class CrawlSort
{
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
