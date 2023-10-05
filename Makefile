.PHONY: dshell

d-compose:
	docker-compose up -d nginx phpmyadmin
	docker-compose run --service-ports --rm --entrypoint=bash php

dshell:
	[ -f "./.env" ] || cp .env.example .env
	echo "http://127.0.0.1:8080/" > public/hot
	make d-compose

setup:
	composer install
	php artisan key:generate
	php artisan migrate
	php artisan db:seed
	php artisan notify:restart

restart:
	docker-compose down
	make d-compose

db-migrate:
	php artisan db:wipe
	php artisan migrate
	php artisan db:seed

test:
	php artisan test

# Remove ignored git files
clean:
	@if [ -d ".git" ]; then git clean -xdf --exclude ".env" --exclude ".idea"; fi

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
