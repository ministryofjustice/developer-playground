<div align="center">

<br>

<img alt="MoJ logo" src="https://moj-logos.s3.eu-west-2.amazonaws.com/moj-uk-logo.png" width="200">

<br><br>

[![PHP Icon]][PHP Link]

## Developer Playground

[![Standards Icon]][Standards Link]
[![License Icon]][License Link]

</div>

# Tooling Procurement Centre

The Tooling Procurement Centre (TPC) aggregates data related to tooling within government digital teams and displays
exploratory reports and structured data for administrative review, financial quantification and high-confidence
decision-making.

:information_desk_person: **This is a developer training resource.**<br>
:arrow_right: **Unless otherwise stated, it is not used in a production environment.**

## Jump to...

* [A note on...](#a-note-on)
    * [Lock files](#lock-files)
    * [Artisan serve](#artisan-serve)
* [Installation](#installation)
    * [Useful commands](#useful-commands)
* [Developing](#developing-the-project)
    * [Docker Compose](#docker-compose)
    * [Writing tests](#writing-tests-tdd)
    * [Asset compilation](#asset-compilation)
    * [Docker](#docker)
    * [Kubernetes](#kubernetes)

---

<div align="center">

![An image of the applications' home page](https://moj-logos.s3.eu-west-2.amazonaws.com/developer-playground-php-app-shot.png)

</div>

---

### Inspiration from [Rawkode Academy](https://rawkode.academy/)

Rawkode Academy have cast some inspiration on this project so it's only fair to give them a mention. Please check
out [David Flanagan](https://www.linkedin.com/in/rawkode/) and his [YouTube channel](https://www.youtube.com/@RawkodeAcademy) if you are interested in learning
about Kubernetes, Cloud Native and DevOps.

:globe_with_meridians: :tv: [Docker, Kubernetes, and PHP: Laravel Edition](https://www.youtube.com/watch?v=CneJf4Amv0U)

## A note on...

### Lock files

The TPC does not allow `.lock` files in source code. The reason is a difference in perception and one that is up for
debate.

Imagine our CI environment is ironclad; we have multiple checks firing off in GitHub Actions, and every inch of our code
is monitored by our **T**est **D**riven **D**evelopment (TDD).
In this scenario, why do we deprive ourselves of security updates in package managers? Why do we prevent security
updates from being installed at the CI stage?

The short answer is we shouldn't. We should feel safe that our CI checks and TDD will protect and inform us should
security updates impact our applications' ability to function.

For this reason, we DO NOT push `.lock` files to the repository. We use TDD to its fullest and allow security updates to
flow as and when they are provided.

### Artisan serve

Laravel comes with a built-in server. It's possible, therefore, to launch an application locally using this, although
this is discouraged. However, for completeness, you could use this command to establish a local server:

```bash
php artisan serve
```

B U T &nbsp; W A I T . . .

Our goal is
to [develop in a pre-production environment](https://www.gov.uk/service-manual/technology/working-in-pre-production-environments).
We hope to use Kubernetes and containerization to achieve this.
The [technology service manual](https://www.gov.uk/service-manual/technology) helps us to understand why we focus on
creating an environment that closely matches production.

Using built-in servers like `artisan serve` pulls us away from testing functionality in a production-like environment.

---
> :sparkles: **Do you have questions?**<br>
> The [Discussions board](https://github.com/ministryofjustice/developer-playground/discussions) is a great place to
> reach the community. :smile:
---

## Installation

The configuration uses multiple Docker containers and volumes to manage ephemeral assets and caching. The view is to
speed up and strengthen the environment for development. The result is a faster loading time with hot reloading of
frontend assets. The focus for this project has been primarily on creating a fluid development environment.

***OSX example***

1. `cd ~/`
2. `git clone https://github.com/ministryofjustice/developer-playground.git tooling-procurement-centre`
3. `cd tooling-procurement-centre`
4. `git checkout php`
5. `make setup`
6. Asset compilation will take around 2 minutes *
7. When ready, visit: http://127.0.0.1:8000/

Nb. *our node container is responsible for compiling project assets; the
containers' [entrypoint](https://docs.docker.com/compose/compose-file/compose-file-v3/#entrypoint) command is a
long-running process started with `npx mix watch`. Watching our files from a dedicated server is helpful in a way that
detaches the dependency from our development workflow.

---
> :sparkles: **Do you have questions?**<br>
> The [Discussions board](https://github.com/ministryofjustice/developer-playground/discussions) is a great place to
> reach the community. :smile:
---

**A consolidated _up and running_ command.**

```bash
cd ~/ && \
git clone https://github.com/ministryofjustice/developer-playground.git tooling-procurement-centre && \
cd tooling-procurement-centre && git checkout php && \
make setup 
```

### Useful commands

You can monitor asset compilation output from the node container. Output is produced by `mix watch`. The terminal view
will update when changes are made to any file tracked in `webpack.mix.js`

```
docker compose logs node -f
```

## Developing the project

### Docker Compose

Docker Compose is used to launch our application locally; we never use `docker compose` in production; however, we
use `docker compose` to recreate production-like environments locally. This section will describe each service.

#### Nginx

This is our web server.<br>
Nginx has one job: to serve our application. Internally, the PHP FPM gateway is routed to the application server, `php`.
In a production environment, we would use `localhost`.

#### PHP

This is our application server.<br>
We can `docker compose exec` into this container and work alongside our code.

This service detaches a dependency on our host machine. For example, you do not need PHP locally to develop on this
project. All application code can be executed in this container and served via Nginx.

#### MariaDB

This is our database server.<br>
The php service is `linked` to MariaDB. Under the hood, `docker compose` manages the network.

#### PhpMyAdmin

This is our data management utility, available in the browser.

---
> :sparkles: **Do you have questions?**<br>
> The [Discussions board](https://github.com/ministryofjustice/developer-playground/discussions) is a great place to
> reach the community. :smile:
---

### Writing tests (TDD)

Tests form the foundation of this project and serve as the stability we rely on when deploying to cloud services.

**Resources**

* [Test Driven Development](https://www.youtube.com/watch?v=1Ur_znd5SNI) with Sam, from Acadia
* [What is TDD? How it works: Simple Example](https://www.youtube.com/watch?v=UHnP7ThzLpE)

### Asset compilation

[Laravel Mix ~ a wrapper around webpack](https://laravel-mix.com/)

[Laravel Mix ~ documentation](https://laravel-mix.com/docs/6.0/installation)

### Docker

Our configuration is located inside `./resources/ops/docker`.

**[What's a container?](https://www.docker.com/resources/what-container/)**<br>
A resource on Docker describing the benefits and use of containers

### Kubernetes

Our configuration is located inside `./resources/ops/kubernetes`.

Launching the application is possible if you have a cluster locally. Configuration may require optimisation, but please
explore the setup.


---
> :sparkles: **Do you have questions?**<br>
> The [Discussions board](https://github.com/ministryofjustice/developer-playground/discussions) is a great place to
> reach the community. :smile:
---

## Laravel inside...

<img alt="Laravel logo" src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200">

<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and
creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in
many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache)
  storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


<!-- PHP -->

[PHP Link]: https://github.com/ministryofjustice/developer-playground/tree/php 'Click to view the Laravel application.'

[PHP Icon]: https://badgen.net/badge/PHP/Laravel/fb503b?scale=4&labelColor=484C89&icon=php

<!-- app-shot -->

[App Shot Image]: https://moj-logos.s3.eu-west-2.amazonaws.com/developer-playground-php-app-shot.png

<!-- License -->

[License Link]: https://github.com/ministryofjustice/developer-playground/blob/java/LICENSE 'License.'

[License Icon]: https://img.shields.io/github/license/ministryofjustice/developer-playground?style=for-the-badge

<!-- MoJ Standards -->

[Standards Link]: https://operations-engineering-reports.cloud-platform.service.justice.gov.uk/public-report/developer-playground 'Repo standards badge.'

[Standards Icon]: https://img.shields.io/endpoint?labelColor=231f20&color=005ea5&style=for-the-badge&url=https%3A%2F%2Foperations-engineering-reports.cloud-platform.service.justice.gov.uk%2Fapi%2Fv1%2Fcompliant_public_repositories%2Fendpoint%2Fdeveloper-playground&logo=data:image/png;base64,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
