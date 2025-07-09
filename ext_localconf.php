<?php

defined('TYPO3') || die();

use Causal\Tscobj\Controller\TypoScriptObjectController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function (): void {
    // Add plugin frontend rendering
    ExtensionManagementUtility::addTypoScript('tscobj', 'setup', '
plugin.tx_tscobj_pi1 = USER
plugin.tx_tscobj_pi1 {
	userFunc = ' . TypoScriptObjectController::class . '->main
}

# Setting gkh_rss_import plugin TypoScript
tt_content.list.20.tscobj_pi1 =< plugin.tx_tscobj_pi1
', 'defaultContentRendering');
})();
