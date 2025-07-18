<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\ValueObject\PhpVersion;
use Ssch\TYPO3Rector\CodeQuality\General\ConvertImplicitVariablesToExplicitGlobalsRector;
use Ssch\TYPO3Rector\CodeQuality\General\ExtEmConfRector;
use Ssch\TYPO3Rector\Configuration\Typo3Option;
use Ssch\TYPO3Rector\Set\Typo3LevelSetList;
use Ssch\TYPO3Rector\Set\Typo3SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/../../Build',
        __DIR__ . '/../../Classes',
        __DIR__ . '/../../Configuration',
        __DIR__ . '/../../ext_emconf.php',
        __DIR__ . '/../../ext_localconf.php',
    ]);
    $rectorConfig->phpVersion(PhpVersion::PHP_82);
    $rectorConfig->sets([
        // Rector sets
        LevelSetList::UP_TO_PHP_82,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        //SetList::STRICT_BOOLEANS,
        //SetList::NAMING,
        SetList::PRIVATIZATION,
        SetList::TYPE_DECLARATION,
        SetList::EARLY_RETURN,
        SetList::INSTANCEOF,

        // TYPO3 Sets
        Typo3SetList::CODE_QUALITY,
        Typo3SetList::GENERAL,
        Typo3LevelSetList::UP_TO_TYPO3_13,
    ]);
    $rectorConfig->phpstanConfig(Typo3Option::PHPSTAN_FOR_RECTOR_PATH);
    $rectorConfig->rules([
        AddVoidReturnTypeWhereNoReturnRector::class,
        ConvertImplicitVariablesToExplicitGlobalsRector::class,
    ]);
    $rectorConfig->ruleWithConfiguration(ExtEmConfRector::class, [
        ExtEmConfRector::PHP_VERSION_CONSTRAINT => '8.2.0-8.4.99',
        ExtEmConfRector::TYPO3_VERSION_CONSTRAINT => '13.4.10-13.4.99',
        ExtEmConfRector::ADDITIONAL_VALUES_TO_BE_REMOVED => [],
    ]);
    $rectorConfig->importNames();
    $rectorConfig->importShortClasses(false);
    $rectorConfig->skip([
    ]);
};
