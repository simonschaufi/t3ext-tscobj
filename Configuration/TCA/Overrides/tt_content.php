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

use TYPO3\CMS\Core\Schema\Struct\SelectItem;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Add plugin to list_type dropdown
ExtensionManagementUtility::addPlugin(
    new SelectItem(
        'select',
        'LLL:EXT:tscobj/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1.label',
        'tscobj_pi1',
        'content-special-html',
        null,
        'LLL:EXT:tscobj/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1.description'
    ),
    'FILE:EXT:tscobj/Configuration/FlexForms/flexform_ds_pi1.xml'
);
ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Configuration,pi_flexform,', 'tscobj_pi1', 'after:subheader');
