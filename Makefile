.DEFAULT_GOAL := help

include .env
HOST ?= localhost

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help

##
## Setup
## -----
##

start: .env.local up info ## Start development environment

install: .env.local up
	docker-compose run composer install --ignore-platform-reqs --no-scripts
	docker-compose exec web bash -c "bin/console doctrine:schema:update --force"
# 	docker-compose exec web bash -c "bin/console doctrine:migrations:migrate --no-interaction"

install-dev: install fixtures ## Make install with developer fixtures

.env.local: .env
	@if [ -f .env.local ]; then \
		echo '\033[1;41mYour .env.local file may be outdated because .env has changed.\033[0m';\
		echo '\033[1;41mCheck your .env.local file, or run this command again to ignore.\033[0m';\
		touch .env.local;\
		exit 1;\
	else\
		echo cp .env .env.local;\
		cp .env .env.local;\
	fi

up: ## Run containers
	docker-compose up -d

down: ## Stop and remove containers
	docker-compose down

fixtures: ## Launch fixtures
	docker-compose exec web bash -c "php bin/console doctrine:fixture:load -n"


##
## Tools
## -----
##

test: ## Run test
	docker-compose run composer php bin/phpunit install
	docker-compose exec web bin/phpunit

cc: ## Clear cache
	docker-compose exec web bash -c "php bin/console cache:clear"

cs: ## Executes php cs fixer
	docker-compose exec web bash -c "vendor/bin/php-cs-fixer --no-interaction --diff -v fix"

logs: ## Show logs
	docker-compose logs -ft

bash: ## Bash into php container
	docker-compose exec web bash

node: ## Bash into node container
	docker-compose exec node sh

rewatch: ## Restart node watcher
	docker-compose restart -t 1 node

info: ## Show useful urls
	@echo ""
	@echo "\033[92m[OK] Site running on http://$(HOST):$(RBS_HTTP_PORT)\033[0m"
	@echo ""

##