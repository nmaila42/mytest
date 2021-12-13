#!/bin/bash

gnome-terminal\
    --tab\
        --title="SEVER_START" -- bash -c "cd ~;
	sudo service mysql start;
	mysqladmin -u root -p status;
	mysql -u test '-pdevP@55';
       	$SHELL"\

gnome-terminal\
    --tab\
        --title="Test project" -- bash -c "cd ~/projects/matcha;
        php artisan serve; php artisan storage:link;
        $SHELL"\

phpstorm.sh &

