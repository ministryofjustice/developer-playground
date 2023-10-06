.PHONY: d-shell

d-compose:
	docker compose up -d nginx phpmyadmin
	docker compose run --service-ports --rm --entrypoint=bash php

d-shell: setup d-compose

setup:
	@chmod +x ./bin/*
	@[ -f "./.env" ] || cp .env.example .env
	@echo "http://127.0.0.1:8080/" > public/hot
	@docker compose up -d nginx phpmyadmin
	@docker compose exec php /var/www/html/bin/setup.sh
	@./bin/restart.sh

restart:
	@docker compose down
	@php artisan notify:restart
	@make d-compose


db-migrate:
	php artisan db:wipe
	php artisan migrate
	php artisan db:seed

test:
	php artisan test

down:
	docker compose down -v

# Remove ignored git files
clean:
	@if [ -d ".git" ]; then git clean -xdf --exclude ".env" --exclude ".idea"; fi
	@clear

node-assets:
	npm install
	npm run watch

bash-nginx:
	docker compose exec --workdir /var/www/html nginx bash

bash-node:
	docker compose exec --workdir /node node bash

#####
## Production CI mock
#####

build-nginx:
	docker image build -f resources/ops/docker/nginx/Dockerfile -t tp-centre-nginx:latest --target nginx .

build-fpm:
	docker image build -f resources/ops/docker/fpm/Dockerfile -t tp-centre-fpm:latest --target fpm .

build:
	make build-fpm
	make build-nginx

ks-apply:
	kubectl apply -f resources/ops/kubernetes
