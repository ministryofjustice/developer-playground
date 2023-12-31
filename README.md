<div align="center">

# <img alt="MoJ logo" src="https://moj-logos.s3.eu-west-2.amazonaws.com/moj-uk-logo.png" width="200"><br><br>Developer Playground

[![Standards Icon]][Standards Link]
[![License Icon]][License Link]

<br>

**Multi-language developer resource to assist learning and new-tech exploration:**

[![Ruby Icon]][Ruby Link] &nbsp; [![PHP Icon]][PHP Link] &nbsp; [![DOTNET Icon]][DOTNET Link]

[![Java Icon]][Java Link] &nbsp; [![Python Icon]][Python Link] &nbsp; [![Node Icon]][Node Link]
&nbsp; [![VueJS Icon]][VueJS Link]

</div>

---

Developer Playground is home to many subprojects. Subprojects are essentially test beds for programming languages and
contain what is widely deemed as best practice to achieve good coding.

New subprojects can be added by following this process:

1. Decide your programming language name, one word is best
2. Create your icon
   [using an example like this](https://badgen.net/badge/Lang/other-text/grey?scale=2&labelColor=000000&icon=git) -
   modify the URL to meet need
3. [Contact an admin](https://github.com/orgs/ministryofjustice/teams/developer-playground-administrators) giving
   details of the language name and icon URL

> Please note that Developer Playground has branch-rules in place to protect content and users. An administrator is needed to
> bypass settings to create a new language branch.

> If you are interested in helping to administer, please do reach out.

## Fly the flag for your programming language

Getting involved with your language of choice is a great idea; you can showcase your knowledge as an early adopter and
set the bar for developers of all levels to start experimenting.
It is heavily encouraged to 'weigh in' on pull requests to offer advice and begin discussions. You never know, you might
ignite a spark in the mind of a young programmer.

## Community guidelines

Collaboration necessitates recognising that contributors may possess varying levels of expertise and comprehension. It's
crucial to embrace the diverse perspectives, experiences, and skills our colleagues bring to the table, as this
collective effort can facilitate learning and illuminate previously obscure areas.

We should actively promote even the most minor steps toward positive progress and stand ready to support our colleagues
during difficult times.

### Failure in the pursuit of success

Failure and success are two contrasting outcomes or states that often play a significant role in shaping our lives and
experiences. Here's a breakdown of each concept:

#### Failure

**Learning opportunity:** Failure is often considered a valuable learning experience. It provides insights into what
didn't work and can lead to personal growth and development.

**Emotional impact:** Failure can be emotionally challenging. It may lead to feelings of disappointment, frustration, or
even sadness. However, it can also build resilience and the ability to cope with setbacks.

**Motivation:** Failure can serve as motivation to improve and try again. Many successful individuals have faced
multiple failures before achieving their goals.

**Risk-taking:** Failure is an inherent part of taking risks. Without the possibility of failure, there is often limited
room for innovation and growth.

#### Success

**Recognition:** Success is often accompanied by recognition and praise from others, which can boost self-esteem and
confidence.

**Emotional impact:** Success can bring feelings of happiness, satisfaction, and pride. It can also provide a sense of
accomplishment and validation.

**Motivation:** Success can serve as motivation to continue striving for excellence and setting higher goals.

It's important to note that failure and success are not always mutually exclusive. Many successful individuals have
experienced failure at various points in their lives, and failure can be a stepping stone to eventual success.
Additionally, what is considered a failure or success can be highly subjective and dependent on one's perspective and
goals. Ultimately, both failure and success are part of the journey of life, and how we perceive and respond to them can
shape our future experiences.

---

## Coding and structure

### Orphan branches

Each language branch contained in this project has been orphaned. An orphan branch is a term commonly used in version
control systems like Git. It refers to a branch with no parent or history connection to other branches in the
repository. In other words, an orphan branch is created independently and does not share a common commit history with
any other branch. This branch starts fresh with no commits, and any changes made to it are isolated from the rest of the
project's history until the branch is merged or connected to another branch.

An orphan branch is created using the `git checkout --orphan` command followed by the branch name. For example:

```bash
git checkout --orphan <branch_name>
```

Orphan branches are locked under branch rules and will need pull requests, in the usual way, to add features.

## Conventions

> The community creates conventions, so please do offer your thoughts
> in [Discussions](https://github.com/ministryofjustice/developer-playground/discussions/2)

The headings below offer some support to help us with some housekeeping.

### Branch names (WiP)

This repository houses multiple languages, which can make viewing branches a little tricky. Let us subscribe to the
following convention:

1. Begin branch names with the language your code is intended
2. Follow with a dash `-` and the word `apply`
3. Complete with a forward slash `/`
4. Next, write your branch name as you would normally

You can model it like so:

```
ruby-apply/my-awesome-new-ruby-branch
```

<!-- License -->

[License Link]: https://github.com/ministryofjustice/developer-playground/blob/main/LICENSE 'License.'

[License Icon]: https://img.shields.io/github/license/ministryofjustice/developer-playground?style=for-the-badge

<!-- Ruby -->

[Ruby Link]: https://github.com/ministryofjustice/developer-playground/tree/ruby 'Click to view the Ruby on Rails application.'

[Ruby Icon]: https://badgen.net/badge/Ruby/on%20Rails/D30001?scale=2&labelColor=CC342D&icon=ruby

<!-- PHP -->

[PHP Link]: https://github.com/ministryofjustice/developer-playground/tree/php 'Click to view the Laravel application.'

[PHP Icon]: https://badgen.net/badge/PHP/Laravel/fb503b?scale=2&labelColor=484C89&icon=php

<!-- DOTNET -->

[DOTNET Link]: https://github.com/ministryofjustice/developer-playground/tree/dotnet 'Click to view the .NET application.'

[DOTNET Icon]: https://badgen.net/badge/Microsoft/.NET/512bd4?scale=2&labelColor=09a3ab

<!-- Java -->

[Java Link]: https://github.com/ministryofjustice/developer-playground/tree/java 'Click to view the Java application.'

[Java Icon]: https://badgen.net/badge/Java/Spring/589133?scale=2&labelColor=f89820

<!-- Python -->

[Python Link]: https://github.com/ministryofjustice/developer-playground/tree/python 'Click to view the Python application.'

[Python Icon]: https://badgen.net/badge/Python/Django/44B78B?scale=2&labelColor=4584B6

<!-- Node -->

[Node Link]: https://github.com/ministryofjustice/developer-playground/tree/node 'Click to view the Node.js application.'

[Node Icon]: https://badgen.net/badge/Node.js/%20/77b85b?scale=2&labelColor=3c873b&icon=npm

<!-- VueJS -->

[VueJS Link]: https://github.com/ministryofjustice/developer-playground/tree/vuejs 'Click to see the VueJS application.'

[VueJS Icon]: https://badgen.net/badge/Vue.js/%20/41b883?scale=2&labelColor=34495e

<!-- MoJ Standards -->

[Standards Link]: https://operations-engineering-reports.cloud-platform.service.justice.gov.uk/public-report/developer-playground 'Repo standards badge.'

[Standards Icon]: https://img.shields.io/endpoint?labelColor=231f20&color=005ea5&style=for-the-badge&url=https%3A%2F%2Foperations-engineering-reports.cloud-platform.service.justice.gov.uk%2Fapi%2Fv1%2Fcompliant_public_repositories%2Fendpoint%2Fdeveloper-playground&logo=data:image/png;base64,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

