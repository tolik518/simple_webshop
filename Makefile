VENDORNAME=tolik518
PROJECTNAME=webshop

CLI=PROJECTNAME=$(PROJECTNAME) VENDORNAME=$(VENDORNAME)  docker-compose -p $(PROJECTNAME) -f docker/compose/docker-compose-cli.yml
COMPOSE=PROJECTNAME=$(PROJECTNAME) VENDORNAME=$(VENDORNAME) docker-compose -p $(PROJECTNAME) -f docker/compose/docker-compose-dev.yml

.PHONY: build_dev
build_dev:
	docker build -f docker/php/Dockerfile . \
	-t $(VENDORNAME)/$(PROJECTNAME)/php:dev
	docker build -f docker/nginx/Dockerfile . \
	-t $(VENDORNAME)/$(PROJECTNAME)/nginx:dev
	docker build -f docker/database/Dockerfile . \
	-t $(VENDORNAME)/$(PROJECTNAME)/database:dev
	docker build -f docker/php_cli/Dockerfile . \
	-t $(VENDORNAME)/$(PROJECTNAME)/php_cli:dev

.PHONY: run
run:
	$(COMPOSE) up -d
	docker ps

.PHONY: stop
stop:
	$(COMPOSE) down --remove-orphans
	docker ps

.PHONY: install
install:
	$(CLI) run --rm --no-deps php_cli php -d memory_limit=-1 /usr/bin/composer install

.PHONY: update
update:
	$(CLI) run --rm --no-deps php_cli php -d memory_limit=-1 /usr/bin/composer update

.PHONY: logs
logs:
	$(COMPOSE) logs

.PHONY: cleanup
cleanup:
	docker stop $$(docker ps -a -q)
	docker rm $$(docker ps -a -q)