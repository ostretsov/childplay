#!/bin/sh

usermod -u `stat -c "%u" /var/www/chp` www-data
groupmod -g `stat -c "%g" /var/www/chp` www-data
