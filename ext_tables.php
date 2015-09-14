<?php
defined('TYPO3_MODE') or die ('Access denied.');

// Plugin options
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key,pages,recursive';

// Add flexform fields to plugin options
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';

// Add flexform DataStructures
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/flexform_ds_pi1.xml');

// Add plugins
t3lib_extMgm::addPlugin(array('LLL:EXT:tscobj/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1', $_EXTKEY . '_pi1'), 'list_type');

// Wizard icons
if (TYPO3_MODE === 'BE') {
    $GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['tx_' . $_EXTKEY . '_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY) . 'pi1/class.tx_tscobj_pi1_wizicon.php';
}
