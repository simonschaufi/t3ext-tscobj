# TYPO3 Extension tscobj

[![Latest Stable Version](https://poser.pugx.org/simonschaufi/tscobj/v/stable)](https://packagist.org/packages/simonschaufi/tscobj)
[![Total Downloads](https://poser.pugx.org/simonschaufi/tscobj/downloads)](https://packagist.org/packages/simonschaufi/tscobj)
[![License](https://poser.pugx.org/simonschaufi/tscobj/license)](https://packagist.org/packages/simonschaufi/tscobj)
[![TYPO3](https://img.shields.io/badge/TYPO3-11-orange.svg)](https://typo3.org/)

A plugin which lets you use any TypoScript object as a normal content element.

## Installation

```bash
composer require simonschaufi/tscobj
```

## Usage

Define your TypoScript:

```
lib.test = TEXT
lib.test.value = Show this text as content
```

Add the TypoScript Object Plugin on your page and paste the TypoScript config path `lib.test` in the plugin configuration.
