#!/bin/bash

# this block forces one-time setup on entry and a reinstall if environment changes
if [ ! -f .setup-complete ] || [ "$APP_ENV" != "$(cat .setup-complete)" ]; then
  printf '\e[33mINFO: Beginning a fresh install\e[0m\n'

    # composer
	composer install

    # clean first
    php artisan db:wipe
	php artisan key:generate
	php artisan migrate
	php artisan db:seed

  # create a control file
  # at minimum, this file is referenced in .gitignore and Makefile
  echo "$APP_ENV" > .setup-complete
fi
