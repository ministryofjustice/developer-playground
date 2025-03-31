<div align="center">

<br>

<img alt="MoJ logo" src="https://moj-logos.s3.eu-west-2.amazonaws.com/moj-uk-logo.png" width="200">

<br><br>

[![Ruby Icon]][Ruby Link]

## Developer Playground

[![Standards Icon]][Standards Link]
[![License Icon]][License Link]

</div>


## About The Project

Following the guidance from [Rails getting started](https://guides.rubyonrails.org/getting_started.html#using-a-model-to-interact-with-the-database). This small project functions as a basic application for managing articles. With the ability to comment and use search filters to find content. You can also edit your user details and add an avatar as your profile picture. 

We hope to develop and improve this application as a learning platform for those who love building web applications with Ruby on Rails. 

There are 3 user types: "Admin", "Basic" and "Guest". Each user has different privileges.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## Built With

[![Ruby][Rails-badge]][Ruby-on-Rails-url]
[![Bootstrap][Bootstrap-badge]][Bootstrap-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Current functionality

Article CRUD with comments
User registration with email verification
User accounts, admins can also manage all other users 

## Getting Started

The application has a seeds.rb file to create dummy users with article posts and comments. The comments will be posted on the other users articles. 

### Setting up the database:

Create the database with

```sh
rake db:create
```

Run migrations

```sh
rake db:migrate
```

Seed the database with users with their articles and comments

```sh
rake db:seed
```

If any errors occur you can drop the database and follow the above steps again.

```sh
rake db:drop
```

### Logging in
admin user to see full service privileges. 
```sh
email: adminuser@email.com
password: password
```

basic user. 
```sh
email: basicuser@email.com
password: password
```

guest user. 
```sh
email: guestuser@email.com
password: password
```

### Prerequisites

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/[your_username]/rails_blog.git
   ```
2. Navigate into the project directory
   ```sh
   cd rails_blog 
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>



## Usage

### Signing up 
Sign up to create a user before you can interact with the application. After clicking 'sign up' an authentication token will be displayed within your terminal. Visit the given url to submit the token to verify your user. You MUST do this before you can sign in. 

### User roles
There are 3 different types of users. "Admin", "Basic" and "Guest". 

Admin can see all posts whether private or public, and can also change the roles of other users. Can write posts and comments. Can edit and delete other users articles and comments.

Basic users can see all posts whether private or public, but cannot modify other users. Can write articles or comments.

Guests can only see public posts and comments. No other functionality.

### Testing and test coverage
- [Brakeman](https://github.com/presidentbeef/brakeman) checks for code vulnerabilities. This is run within the github workflow test.yml. To see a full breakdown of the scan locally run: ```brakeman```.
 
- [Simplecov](https://github.com/simplecov-ruby/simplecov) runs when a test is executed ```bundle exec rspec```. To see a full breakdown of test coverage run ```open coverage/index.html``` in the root directory.

### Linting and Style
- [Rubocop](https://gist.github.com/jhass/a5ae80d87f18e53e7b56#file-rubocop-yml) for code style and linting. The ```rubocop.yaml``` config file sets the desired cops. To detect all offences enter the command ```rubocop```. To detect and change offences run ```rubocop -A```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Potential Issues

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## Known issues


<p align="right">(<a href="#readme-top">back to top</a>)</p>


## Guides

### Run with bare metal installation

The application can be run using a bare metal installation. 

   ```sh
   rails s
   ```

### Run with Docker - NOT YET IMPLEMENTED

The application will be run using Docker for configuration exercises and further development. 

[Docker - Get started](https://docs.docker.com/get-started/)
You can use this [guide](https://www.youtube.com/watch?v=J7hUHnQtFNo) to create the docker image for the application

## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



## Contact

Project Link: [https://github.com/your_username/repo_name](https://github.com/your_username/repo_name)

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## Acknowledgments

Use this space to list resources you find helpful and would like to give credit to.

* [Choose an Open Source License](https://choosealicense.com)
* [Img Shields](https://shields.io)
* https://github.com/othneildrew/Best-README-Template
* [Rails Getting started](https://guides.rubyonrails.org/getting_started.html)
* [Rails Odin Project](https://www.theodinproject.com/paths/full-stack-ruby-on-rails/courses/ruby-on-rails)
* [Rubocop config](https://gist.github.com/jhass/a5ae80d87f18e53e7b56#file-rubocop-yml)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-url]: https://github.com/othneildrew/Best-README-Template/graphs/contributors
[Bootstrap-badge]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[Ruby-on-Rails-url]: https://rubyonrails.org
[Rails-badge]: https://img.shields.io/badge/rails-%23CC0000.svg?style=for-the-badge&logo=ruby-on-rails&logoColor=white
<!-- Ruby -->
[Ruby Link]: https://github.com/ministryofjustice/developer-playground/tree/ruby 'Click to view the Ruby on Rails application.'
[Ruby Icon]: https://badgen.net/badge/Ruby/on%20Rails/D30001?scale=4&labelColor=CC342D&icon=ruby
<!-- License -->
[License Link]: https://github.com/ministryofjustice/developer-playground/blob/java/LICENSE 'License.'
[License Icon]: https://img.shields.io/github/license/ministryofjustice/developer-playground?style=for-the-badge

<!-- MoJ Standards -->
[Standards Link]: https://operations-engineering-reports.cloud-platform.service.justice.gov.uk/public-report/developer-playground 'Repo standards badge.'
[Standards Icon]: https://img.shields.io/endpoint?labelColor=231f20&color=005ea5&style=for-the-badge&url=https%3A%2F%2Foperations-engineering-reports.cloud-platform.service.justice.gov.uk%2Fapi%2Fv1%2Fcompliant_public_repositories%2Fendpoint%2Fdeveloper-playground&logo=data:image/png;base64,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
