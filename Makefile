.DEFAULT_GOAL := help
.PHONY: help start stop restart stat set-up-defaults __create-required-directories sh sh-cmd
.PHONY: start-feature-branch sfb finish-feature-branch ffb git-commit-push gcp
.PHONY: dbreset dbsync dbdump
.PHONY: test _prepare-for-tests
.PHONY: fix-code-style psalm

help:									## Show this help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/' | sort

start:                                  ## Start the project.
	make __create-required-directories
	docker-compose rm -f
	docker-compose up -d --remove-orphans
	make stat

stop:
	docker-compose stop

restart:
	make stop
	make start

stat:
	docker-compose ps

set-up-defaults:                        ## Set up default configuration. SURE and ENV variables must be declared! ENV could be "prod" or "dev".
	@echo Setting up the project...
	@if test "$(SURE)" = "" ; then \
	        echo "You must be SURE to do it!"; \
        	exit 1; \
	fi
	@if test "$(ENV)" = "" ; then \
            echo "ENV must be defined!"; \
            exit 1; \
    fi
	touch docker/php/bash/.bash_history
	make __create-required-directories

	@if [ "$(ENV)" = "dev" ]; then \
            cp -f .env.dev .env; \
            cp -f phpunit.xml.dist phpunit.xml; \
#    elif [ "$(ENV)" = "prod" ]; then \
#    		cp -f docker-compose.yml.prod docker-compose.yml; \
#    		cp -f docker/php/Dockerfile.prod docker/php/Dockerfile; \
	fi

__create-required-directories:            ## Private target! Create required directory structure.
	mkdir -p translations
	mkdir -p data/phpsession data/postgres
	mkdir -p var/log/nginx

sfb:                                    ## Alias for start-feature-branch.
	make start-feature-branch

start-feature-branch:                   ## Start feature branch. N must be specified. N stands for (issue) Number.
	@if test "$(N)" = "" ; then \
	        echo "Issue number N must be defined!"; \
        	exit 1; \
	fi
	git checkout -b feature/CHP-$(N) master

ffb:                                    ## Alias for finish-feature-branch.
	make finish-feature-branch

finish-feature-branch:                   ## Finish feature branch. You must be on the target feature branch.
	@$(eval CURRENT_BRANCH=$(shell git rev-parse --abbrev-ref HEAD))
	if case $(CURRENT_BRANCH) in feature*) true;; *) false;; esac; then \
		echo "Finishing $(CURRENT_BRANCH)..."; \
		git checkout master; \
		git merge --no-ff $(CURRENT_BRANCH); \
		git branch -d $(CURRENT_BRANCH); \
		git push origin; \
		git push origin --delete $(CURRENT_BRANCH); \
    else \
    	echo "You must be on the target feature branch!"; \
    	exit 1; \
    fi

gcp:                                    ## Alias for git-commit-push.
	make git-commit-push

git-commit-push:                        ## Commit changes and push. Especially useful for working with feature branches. M(essage) var must be specified!
	@if test "$(M)" = "" ; then \
	        echo "M(essage) must be specified!"; \
        	exit 1; \
	fi
	make fix-code-style
	make psalm
	@$(eval CURRENT_BRANCH=$(shell git rev-parse --abbrev-ref HEAD))
#	@$(eval ISSUE=$(shell git rev-parse --abbrev-ref HEAD | cut -d'-' -f2))
#	@$(eval MESSAGE=`echo CHP-$(ISSUE) $(M)`)
	git add .
#	git commit -m "$(MESSAGE)"
	git commit -m "$(M)"
	git push origin $(CURRENT_BRANCH)

sh:                                     ## Get into PHP container shell.
	PHP=`docker-compose ps -q php`; \
        docker exec -ti $$PHP sudo -u www-data COLUMNS=`tput cols` LINES=`tput lines` HOME=/home/www-data /bin/bash

sh-cmd:									## Execute a command in PHP container. CMD (for command) variable must be specified!
	PHP=`docker-compose ps -q php`; \
		docker exec $$PHP sudo -u www-data COLUMNS=`tput cols` LINES=`tput lines` HOME=/home/www-data /bin/sh -c "$$CMD"

db-reset:								## Recreate the database. DBPASS variable must be specified.
	if test "$(DBPASS)" = "" ; then \
            echo "DBPASS is not set"; \
            exit 1; \
    fi
	make stop
	docker-compose up -d postgres 2>&1
	DB=`docker-compose ps -q postgres`; \
		sleep 10; \
		docker exec $$DB dropdb -Upostgres --if-exists chp; \
		docker exec $$DB psql -Upostgres -c 'DROP ROLE IF EXISTS chp;'; \
		docker exec $$DB psql -Upostgres -c 'CREATE DATABASE chp;'; \
		docker exec $$DB psql -Upostgres -c "CREATE USER chp WITH password '$(DBPASS)';"; \
		docker exec $$DB psql -Upostgres -c 'GRANT ALL privileges ON DATABASE chp TO chp;'
	make restart

db-restore:								## Restore the database from FILE. FILE is used by curl thus allows variety of protocols: file://, http://, etc.
	if test "$(FILE)" = "" ; then \
        	echo "FILE is not set"; \
	        exit 1; \
	fi
	make dbreset
	rm -f ./tmp/db.sql.gz
	curl ${FILE} > ./tmp/db.sql.gz
	gunzip ./tmp/db.sql.gz
	docker-compose up -d postgres 2>&1
	DB=`docker-compose ps -q postgres`; \
		sleep 10; \
		docker cp ./tmp/db.sql $$DB:/tmp/db.sql; \
		docker exec $$DB bash -c 'psql -Upostgres chp < /tmp/db.sql'; \
		docker exec $$DB rm -f /tmp/db.sql
	rm -f ./tmp/db.sql*

db-dump:								## Dump the database.
	DB=`docker-compose ps -q postgres`; \
	   docker exec $$DB bash -c 'pg_dump -U chp chp >/tmp/latest.sql'; \
	   docker exec $$DB bash -c 'gzip /tmp/latest.sql'; \
	   docker cp $$DB:/tmp/latest.sql.gz /tmp/latest.sql.gz; \
	   docker exec $$DB bash -c 'rm -f /tmp/latest.sql.gz'
	@echo "DB dump is ready: /tmp/latest.sql.gz!"

#BUILD_EXTRA ?=
#test:									## Launch tests of the project. BUILD_EXTRA might be used (e.g. "--no-cache", etc.).
#	make __create-required-directories
#	docker build -f docker/php/Dockerfile.test --rm $(BUILD_EXTRA) -t chp/test/php:latest docker/php
#	docker run --rm -u`id -u`:`id -g` -v `pwd`:/var/www/chp -w /var/www/chp chp/test/php:latest composer install
#	docker run --rm -u`id -u`:`id -g` -v `pwd`:/var/www/chp -w /var/www/chp chp/test/php:latest vendor/phpunit/phpunit/phpunit -c phpunit.xml

fix-code-style:							## Fix code style with php-cs-fixer.
	make sh-cmd CMD="cd /var/www/chp && vendor/bin/php-cs-fixer fix --config ./.php_cs"

psalm:
	make sh-cmd CMD="cd /var/www/chp && ./vendor/bin/psalm --show-info=false"