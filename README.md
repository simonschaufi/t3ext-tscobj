# TYPO3 Extension tscobj

[![Latest Stable Version](https://poser.pugx.org/causal/tscobj/v/stable)](https://packagist.org/packages/causal/tscobj)
[![Total Downloads](https://poser.pugx.org/causal/tscobj/downloads)](https://packagist.org/packages/causal/tscobj)
[![License](https://poser.pugx.org/causal/tscobj/license)](https://packagist.org/packages/causal/tscobj)
[![TYPO3](https://img.shields.io/badge/TYPO3-11.4-orange.svg)](https://typo3.org/)

A plugin which lets you use any TypoScript object as a normal content element.

## Installation

```bash
composer require causal/tscobj
```

## Usage

Define your TypoScript:

```
lib.test = TEXT
lib.test.value = Show this text as content
```

Add the Typoscript Object Plugin on your page and paste the typoscript config path `lib.test` in the plugin configuration.
