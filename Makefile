
CLI=docker-compose -f docker/compose/docker-compose-cli.yml

.PHONY: build_dev
build_dev:
	docker build -f docker/php/Dockerfile . \
	-t af.flyeralarm/new_project/php:dev
	docker build -f docker/nginx/Dockerfile . \
	-t af.flyeralarm/new_project/nginx:dev
	docker build -f docker/database/Dockerfile . \
	-t af.flyeralarm/new_project/database:dev
	docker build -f docker/php_cli/Dockerfile . \
	-t af.flyeralarm/new_project/php_cli:dev

.PHONY: run
run:
	docker-compose -f docker/compose/docker-compose-dev.yml up -d

.PHONY: stop
stop:
	docker-compose -f docker/compose/docker-compose-dev.yml down

.PHONY: install
install:
	$(CLI) run --rm --no-deps php_cli php -d memory_limit=-1 /usr/local/bin/composer install

.PHONY: update
update:
	$(CLI) run --rm --no-deps php_cli php -d memory_limit=-1 /usr/local/bin/composer update

.PHONY: validate
validate:
	code/vendor/bin/phpcs -w -p -s --standard=code/vendor/flyeralarm/php-code-validator/ruleset.xml code/src/