<?php
defined('TYPO3_MODE') || die ('Access denied.');

// Add plugin
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('Causal.Tscobj', 'setup', '
plugin.tx_tscobj_pi1 = USER
plugin.tx_tscobj_pi1 {
	userFunc = ' . \Causal\Tscobj\Controller\TypoScriptObjectController::class . '->main
}

# Setting gkh_rss_import plugin TypoScript
tt_content.list.20.tscobj_pi1 = < plugin.tx_tscobj_pi1
', 'defaultContentRendering');

// Hook in Web > Page content (for TypoScript path preview in content element)
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['tscobj_pi1'] =
    \Causal\Tscobj\Hooks\PageLayoutViewDrawItemHook::class;
