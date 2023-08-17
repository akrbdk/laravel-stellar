# Makefile

SHELL = /bin/bash

ifndef VERBOSE
MAKEFLAGS += --no-print-directory
endif

include $(PWD)/.env.example
-include $(PWD)/.env

.SILENT: php

install-backend: init-env up-backend
	@make composer-install
	@make docker-exec CONTAINER="php" CONTAINER_CMD="sh -c 'php artisan storage:link --force'"
	@make docker-exec CONTAINER="php" CONTAINER_CMD="sh -c 'php artisan key:generate'"

up-backend:
	@make docker-compose-exec COMPOSE_CMD="up -d web"

down:
	@make docker-compose-exec COMPOSE_CMD="down"

init-env:
	@test -f .env || cp .env.example .env

clear-cache: init-env up-backend
	@make docker-exec CONTAINER="php" CONTAINER_CMD="php artisan optimize:clear"

composer-install:
	@make docker-exec CONTAINER="php" CONTAINER_CMD="composer install -n"

docker-exec:
	@docker exec -it $(APP_NAME)-$(CONTAINER) $(CONTAINER_CMD)

docker-compose-exec:
	@docker compose $(COMPOSE_CMD)

php:
	@make docker-exec CONTAINER="php" CONTAINER_CMD="bash"
