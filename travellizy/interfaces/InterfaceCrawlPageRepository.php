<?php

interface InterfaceCrawlPageRepository
{
    function addPage(CrawlEntity $page);
    function existByUri( $uri );
    function getAll();
}
