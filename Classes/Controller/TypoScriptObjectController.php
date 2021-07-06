<?php
declare(strict_types=1);

namespace Causal\Tscobj\Controller;

use Causal\Tscobj\Exception\ObjectNotFoundException;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Frontend\Plugin\AbstractPlugin;

/**
 * Plugin 'TypoScript Object' for the 'tscobj' extension.
 *
 * @author      Jean-David Gadina <macmade@gadlab.net>
 */
class TypoScriptObjectController extends AbstractPlugin
{
    public $prefixId = 'tx_tscobj_pi1';

    public $extKey = 'tscobj';

    /**
     * Returns the content object of the plugin.
     *
     * This function initialises the plugin 'tx_tscobj_pi1', and
     * launches the needed functions to correctly display the plugin.
     *
     * @param string $content The content object
     * @param array $conf The TS setup
     * @return string The content of the plugin
     */
    public function main(string $content, array $conf)
    {
        $this->conf = $conf;
        $this->pi_setPiVarDefaults();
        $this->pi_loadLL('EXT:tscobj/Resources/Private/Language/locallang.xlf');
        $this->pi_initPIflexForm();

        $typoScriptObjectPath = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'object');

        if (!$typoScriptObjectPath) {
            return  '';
        }

        $templatePath = explode('.', $typoScriptObjectPath);

        try {
            [$contentType, $typoScriptObject] = $this->validateTemplatePath($templatePath);
        } catch (ObjectNotFoundException $exception) {
            return '<strong>' . $this->pi_getLL('errors.notfound') . '</strong> (' . $typoScriptObjectPath . ')';
        }

        if (!isset($GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'][$contentType])) {
            // Invalid content type
            return '<strong>' . $this->pi_getLL('errors.invalid') . '</strong> (' . $contentType . ')';
        }

        $renderedObject = $this->cObj->cObjGetSingle($contentType, $typoScriptObject);

        return (bool)$this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'htmlspecialchars')
            ? nl2br(htmlspecialchars($renderedObject))
            : $renderedObject;
    }

    /**
     * @param array $templatePath
     * @return array
     * @throws ObjectNotFoundException
     */
    protected function validateTemplatePath(array $templatePath): array
    {
        $contentType = '';
        $typoScriptObject = $this->getTypoScriptFrontendController()->tmpl->setup;

        $templatePaths = count($templatePath);
        for ($i = 0; $i < $templatePaths; $i++) {
            // Get content type
            $contentType = $typoScriptObject[$templatePath[$i]];

            // Get TS object configuration
            $typoScriptObject = $typoScriptObject[$templatePath[$i] . '.'];

            // Check object
            if (!$contentType && !$typoScriptObject) {
                throw new ObjectNotFoundException('');
            }
        }

        return [$contentType, $typoScriptObject];
    }

    protected function getTypoScriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}
