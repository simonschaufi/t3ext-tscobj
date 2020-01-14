<?php
defined('TYPO3_MODE') || die();

// Add flexform DataStructures
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'tscobj_pi1',
    'FILE:EXT:tscobj/Configuration/FlexForms/flexform_ds_pi1.xml'
);

// Add plugins
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin([
    'LLL:EXT:tscobj/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1',
    'tscobj_pi1'
], 'list_type');
