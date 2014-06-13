<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

// Add plugin
t3lib_extMgm::addPItoST43($_EXTKEY,'pi1/class.tx_tscobj_pi1.php','_pi1','list_type',1);

// Hook in Web > Page
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info'][$_EXTKEY . '_pi1'][] = 'EXT:' . $_EXTKEY . '/pi1/class.tx_tscobj_pi1_info.php:tx_tscobj_pi1_info->getInfo';
