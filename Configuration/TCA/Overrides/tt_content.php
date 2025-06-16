<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * (c) Simon Schaufelberger
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

defined('TYPO3') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

(static function (): void {
    // Add plugin to list_type dropdown
    ExtensionManagementUtility::addPlugin(
        [
            'LLL:EXT:tscobj/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1',
            'tscobj_pi1',
            'content-special-html',
        ],
        ExtensionUtility::PLUGIN_TYPE_PLUGIN,
        'tscobj'
    );

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['tscobj_pi1'] = 'layout,select_key,pages,recursive';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['tscobj_pi1'] = 'pi_flexform';

    // Add flexform DataStructures
    ExtensionManagementUtility::addPiFlexFormValue(
        'tscobj_pi1',
        'FILE:EXT:tscobj/Configuration/FlexForms/flexform_ds_pi1.xml'
    );
})();
