# TYPO3 Extension tscobj

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/simonschaufi/10)
[![Latest Stable Version](https://poser.pugx.org/simonschaufi/tscobj/v/stable)](https://packagist.org/packages/simonschaufi/tscobj)
[![Total Downloads](https://poser.pugx.org/simonschaufi/tscobj/downloads)](https://packagist.org/packages/simonschaufi/tscobj)
[![License](https://poser.pugx.org/simonschaufi/tscobj/license)](https://packagist.org/packages/simonschaufi/tscobj)
[![TYPO3](https://img.shields.io/badge/TYPO3-14-orange.svg)](https://get.typo3.org/version/14)

A TYPO3 extension which lets you use any TypoScript object as a normal content element.

## Documentation

See [tscobj Extension documentation][1]

## Usage

### Installation

#### Installation using Composer

The recommended way to install the extension is using [Composer][2].

Run the following command within your Composer based TYPO3 project:

```bash
composer require simonschaufi/tscobj
```

#### Installation from TYPO3 Extension Repository (TER)

Download and install the [extension][3] with the extension manager module in the TYPO3 backend.

## Integration

Define your TypoScript:

```
lib.test = TEXT
lib.test.value = Show this text as content
```

Add the TypoScript Object Plugin on your page and paste the TypoScript config path `lib.test` in the plugin configuration.

### Release Management

We follow [**semantic versioning**][4], which means, that
* **bugfix updates** (e.g. 1.0.0 => 1.0.1) just includes small bugfixes or security relevant stuff without breaking changes,
* **minor updates** (e.g. 1.0.0 => 1.1.0) includes new features and smaller tasks without breaking changes,
* and **major updates** (e.g. 1.0.0 => 2.0.0) breaking changes which can be refactorings, features or bugfixes.

### Contribution

**Pull Requests** are gladly welcome!
Please remember to add an issue and connect it to your pull requests.
This is very helpful to understand
what kind of issue the **PR** is going to solve.

Bugfixes:
Please describe what kind of bug your fix solve
and give us feedback on how to reproduce the issue.
We're going to accept only bugfixes if we can reproduce the issue.

[1]: https://docs.typo3.org/p/simonschaufi/tscobj/main/en-us/
[2]: https://getcomposer.org/
[3]: https://extensions.typo3.org/extension/tscobj
[4]: https://semver.org/
