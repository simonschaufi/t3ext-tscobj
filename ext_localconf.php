<?php

defined('TYPO3') || die();

use Causal\Tscobj\Controller\TypoScriptObjectController;
use Causal\Tscobj\FormEngine\FieldControl\ImportDataControl;
use Causal\Tscobj\Hooks\PageLayoutViewDrawItemHook;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function () {
    // Add plugin frontend rendering
    ExtensionManagementUtility::addTypoScript('tscobj', 'setup', '
plugin.tx_tscobj_pi1 = USER
plugin.tx_tscobj_pi1 {
	userFunc = ' . TypoScriptObjectController::class . '->main
}

# Setting gkh_rss_import plugin TypoScript
tt_content.list.20.tscobj_pi1 =< plugin.tx_tscobj_pi1
', 'defaultContentRendering');

    // This renders the wizard icon in the plugin options
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1485351217] = [
        'nodeName' => 'importDataControl',
        'priority' => 30,
        'class' => ImportDataControl::class
    ];

    ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:tscobj/Configuration/TSconfig/Page/Mod/Wizards/NewContentElement.typoscript">'
    );

    // Hook in Web > Page content (for TypoScript path preview in content element)
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['tscobj_pi1'] =
        PageLayoutViewDrawItemHook::class;
})();