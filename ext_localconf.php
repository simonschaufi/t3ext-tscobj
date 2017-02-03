<?php
defined('TYPO3_MODE') || die ('Access denied.');

// Add plugin
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY, 'Classes/Controller/Pi1/Pi1Controller.php', '_pi1', 'list_type', 1);

// Hook in Web > Page
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info'][$_EXTKEY . '_pi1'][] = 'EXT:' . $_EXTKEY . '/Classes/Controller/Pi1/class.tx_tscobj_pi1_info.php:tx_tscobj_pi1_info->getInfo';

if (!class_exists('tx_tscobj_pi1', false)) {
    class tx_tscobj_pi1 extends \Causal\Tscobj\Controller\Pi1\Pi1Controller {}
}
