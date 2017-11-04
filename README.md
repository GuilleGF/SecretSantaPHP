# SecretSantaPHP

[![Build Status](https://travis-ci.org/GuilleGF/SecretSantaPHP.svg?branch=master)](https://travis-ci.org/GuilleGF/SecretSantaPHP)
[![Code Coverage](https://scrutinizer-ci.com/g/GuilleGF/SecretSantaPHP/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GuilleGF/SecretSantaPHP/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GuilleGF/SecretSantaPHP/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GuilleGF/SecretSantaPHP/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/5821ae0d89f0a91d55eb9600/badge.svg)](https://www.versioneye.com/user/projects/5821ae0d89f0a91d55eb9600)
[![Latest Stable Version](https://poser.pugx.org/guillegf/secret-santa/v/stable)](https://packagist.org/packages/guillegf/secret-santa)
[![Total Downloads](https://poser.pugx.org/guillegf/secret-santa/downloads)](https://packagist.org/packages/guillegf/secret-santa)
[![License](https://poser.pugx.org/guillegf/secret-santa/license)](https://packagist.org/packages/guillegf/secret-santa)

* Repository: https://github.com/GuilleGF/SecretSantaPHP
* Version: 1.3.0
* License: MIT, see [LICENSE](LICENSE)

## Description

Secret Santa game in PHP

## Installation

### Composer (Recommended)

[Composer](https://getcomposer.org/) is a widely used dependency manager for PHP
packages. Is available on Packagist as
[`guillegf/secret-santa`](https://packagist.org/packages/guillegf/secret-santa) and can be
installed either by running the `composer require` command or adding the library
to your `composer.json`. To enable Composer for you project, refer to the
project's [Getting Started](https://getcomposer.org/doc/00-intro.md)
documentation.

To add this dependency using the command, run the following from within your
project directory:
```
composer require guillegf/secret-santa "~1.3"
```

Alternatively, add the dependency directly to your `composer.json` file:
```json
"require": {
    "guillegf/secret-santa": "~1.3"
}
```
## Usage

In this example in total we add 10 players, 2 singles players, 2 couples (exclusive) and 4 exclusive players.

**The couples and exclusive players never match together.**

```php
<?php
$secretSanta = new SecretSanta();
$secretSanta->addPlayer('Player1', 'player1@email.com')
  ->addPlayer('Player2', 'player2@email.com')
  ->addCouple('Player3', 'player3@email.com', 'Couple3', 'couple3@email.com')
  ->addCouple('Player4', 'player4@email.com', 'Couple4', 'couple4@email.com')
  ->addExclusivePlayers(
      ['Player5', 'player5@email.com'],
      ['Player6', 'player6@email.com'],
      ['Player7', 'player7@email.com'],
      ['Player8', 'player8@email.com']
  );
  
foreach ($secretSanta->play() as $player) {
     echo ("{$player->name()} ({$player->email()}): {$player->secretSanta()->name()}\n");
}
```
The above example will output:

```php
Player1 (player1@email.com): Player5
Player2 (player2@email.com): Player7
Player3 (player3@email.com): Player2
Couple3 (couple3@email.com): Player8
Player4 (player4@email.com): Player3
Couple4 (couple4@email.com): Player6
Player5 (player5@email.com): Player4
Player6 (player6@email.com): Player1
Player7 (player7@email.com): Couple3
Player8 (player8@email.com): Couple4
```

## License

The SecretSanta is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)  
