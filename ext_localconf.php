<?php

defined('TYPO3') || die();

use Causal\Tscobj\Controller\TypoScriptObjectController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function (): void {
    // Add default rendering for pi_layout plugin. Similar like:
    /** @see \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin */
    $pluginSignature = 'tscobj_pi1';
    $pluginContent = trim('
plugin.tx_tscobj_pi1 = USER
plugin.tx_tscobj_pi1 {
	userFunc = ' . TypoScriptObjectController::class . '->main
}

tt_content.' . $pluginSignature . ' =< lib.contentElement
tt_content.' . $pluginSignature . ' {
    templateName = Generic
    20 =< plugin.tx_tscobj_pi1
}');

    // Add plugin frontend rendering
    ExtensionManagementUtility::addTypoScript(
        'tscobj',
        'setup',
        $pluginContent,
        'defaultContentRendering'
    );
})();
