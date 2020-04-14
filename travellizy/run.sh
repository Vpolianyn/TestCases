#!/bin/bash
docker run -it --rm -v /home:/home -w $PWD php:cli php crawl_through.php $@
