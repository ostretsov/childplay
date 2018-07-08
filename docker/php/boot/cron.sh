#!/bin/sh

# crontab root
#(echo "0 * * * * cmd1") | crontab -
#(crontab -l; echo "0 0 * * 0 cmd2") | crontab -

# crontab www-data
#(echo "0 * * * * cmd1") | crontab -u www-data -
#(crontab -u www-data -l; echo "* * * * * cmd2") | crontab -u www-data -
