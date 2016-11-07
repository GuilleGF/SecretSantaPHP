# SecretSantaPHP

[![Build Status](https://travis-ci.org/GuilleGF/SecretSantaPHP.svg?branch=master)](https://travis-ci.org/GuilleGF/SecretSantaPHP)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GuilleGF/SecretSantaPHP/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GuilleGF/SecretSantaPHP/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/guillegf/secret-santa/v/stable)](https://packagist.org/packages/guillegf/secret-santa)
[![Total Downloads](https://poser.pugx.org/guillegf/secret-santa/downloads)](https://packagist.org/packages/guillegf/secret-santa)
[![License](https://poser.pugx.org/guillegf/secret-santa/license)](https://packagist.org/packages/guillegf/secret-santa)

* Repository: https://github.com/GuilleGF/SecretSantaPHP
* Version: 1.0.3
* License: MIT, see [LICENSE](LICENSE)

## Description

Secret Santa game in PHP

## Installation

### Composer (Recommended)

[Composer](https://getcomposer.org/) is a widely used dependency manager for PHP
packages. This reCAPTCHA client is available on Packagist as
[`guillegf/secret-santa`](https://packagist.org/packages/guillegf/secret-santa) and can be
installed either by running the `composer require` command or adding the library
to your `composer.json`. To enable Composer for you project, refer to the
project's [Getting Started](https://getcomposer.org/doc/00-intro.md)
documentation.

To add this dependency using the command, run the following from within your
project directory:
```
composer require guillegf/secret-santa "~1.0"
```

Alternatively, add the dependency directly to your `composer.json` file:
```json
"require": {
    "guillegf/secret-santa": "~1.0"
}
```
## Usage

```php
<?php
$secretSanta = new SecretSanta();
$secretSantaPlayers = $secretSanta
  ->addPlayer('Player', 'player@email.com')
  ->addCouple('Player2', 'player2@email.com', 'Couple2', 'couple2@email.com')
  ->addCouple('Player3', 'player3@email.com', 'Couple3', 'couple3@email.com')
  ->play();
  
foreach ($secretSantaPlayers as $player) {
    echo ("{$player['name']} {$player['email']}:  {$player['secretSanta']}\n");
}
```
