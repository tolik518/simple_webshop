VENDORNAME=tolik518
PROJECTNAME=webshop

.PHONY: build
build:
	docker compose build

.PHONY: run
run:
	docker compose up -d
	docker ps

.PHONY: stop
stop:
	docker compose down --remove-orphans
	docker ps

.PHONY: install
install:
	docker compose run --rm --no-deps php_cli php -d memory_limit=-1 /usr/local/bin/composer install

.PHONY: update
update:
	docker compose run --rm --no-deps php_cli php -d memory_limit=-1 /usr/local/bin/composer update

.PHONY: logs
logs:
	docker compose logs

.PHONY: cleanup
cleanup:
	docker stop $$(docker ps -a -q)
	docker rm $$(docker ps -a -q)