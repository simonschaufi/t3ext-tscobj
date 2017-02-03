<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this TYPO3 code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Causal\Tscobj\Controller\Pi1;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Plugin 'TypoScript Object' for the 'tscobj' extension.
 *
 * @author      Jean-David Gadina <macmade@gadlab.net>
 */
class Pi1Controller extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin
{

    /***************************************************************
     * SECTION 0 - VARIABLES
     *
     * Class variables for the plugin.
     ***************************************************************/

    // Same as class name
    var $prefixId = 'tx_tscobj_pi1';

    // Path to this script relative to the extension dir
    var $scriptRelPath = 'Classes/Controller/Pi1/Pi1Controller.php';

    // The extension key
    var $extKey = 'tscobj';

    // Available content objets
    var $cTypes = array(
        'HTML',
        'TEXT',
        'COBJ_ARRAY',
        'COA',
        'COA_INT',
        'FILE',
        'IMAGE',
        'IMG_RESOURCE',
        'CLEARGIF',
        'CONTENT',
        'RECORDS',
        'HMENU',
        'CTABLE',
        'OTABLE',
        'COLUMNS',
        'HRULER',
        'IMGTEXT',
        'CASE',
        'LOAD_REGISTER',
        'RESTORE_REGISTER',
        'FORM',
        'SEARCHRESULT',
        'USER',
        'USER_INT',
        'PHP_SCRIPT',
        'PHP_SCRIPT_INT',
        'PHP_SCRIPT_EXT',
        'TEMPLATE',
        'MULTIMEDIA',
        'EDITPANEL',
        'FLUIDTEMPLATE',
    );

    /***************************************************************
     * SECTION 1 - MAIN
     *
     * Functions for the initialization and the output of the plugin.
     ***************************************************************/

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
    public function main($content, array $conf)
    {

        // Set class confArray TS from the function
        $this->conf = $conf;

        // Set default plufin variables
        $this->pi_setPiVarDefaults();

        // Load LOCAL_LANG values
        $this->pi_loadLL();

        // Init flexform configuration of the plugin
        $this->pi_initPIflexForm();

        // Get TS object path
        $tsObjPath = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'object');

        // Check for a non empty value
        if ($tsObjPath) {

            // Get complete TS template
            $tmpl = $GLOBALS['TSFE']->tmpl->setup;

            // Get TS object hierarchy in template
            $tmplPath = explode('.', $tsObjPath);

            // Final TS object storage
            $tsObj = $tmpl;

            // Process TS object hierarchy
            for ($i = 0; $i < count($tmplPath); $i++) {

                // Try to get content type
                $cType = $tsObj[$tmplPath[$i]];

                // Try to get TS object configuration array
                $tsObj = $tsObj[$tmplPath[$i] . '.'];

                // Check object
                if (!$cType && !$tsObj) {

                    // Object doesn't exist
                    $error = 1;
                    break;
                }
            }

            // Check object and content type
            if ($error) {

                // Object not found
                return '<strong>' . $this->pi_getLL('errors.notfound') . '</strong> (' . $tsObjPath . ')';

            } elseif (in_array($cType, $this->cTypes)) {

                // Use htmlspecialchars to render object?
                $code = ($this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'htmlspecialchars'))
                    ? nl2br(htmlspecialchars($this->cObj->cObjGetSingle($cType, $tsObj)))
                    : $this->cObj->cObjGetSingle($cType, $tsObj);

            } else {

                // Invalid content type
                return '<strong>' . $this->pi_getLL('errors.invalid') . '</strong> (' . $cType . ')';
            }

            // Return object
            return $code;
        }

        return '';
    }

    /**
     * Loads the locallang file.
     *
     * @return void
     */
    public function pi_loadLL($languageFilePath = '')
    {
        if (!$this->LOCAL_LANG_loaded && $this->scriptRelPath) {
            $basePath = 'EXT:' . $this->extKey . '/Resources/Private/Language/locallang.xlf';

            // Read the strings in the required charset (since TYPO3 4.2)
            /** @var $languageFactory \TYPO3\CMS\Core\Localization\LocalizationFactory */
            $languageFactory = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Localization\\LocalizationFactory');
            $this->LOCAL_LANG = $languageFactory->getParsedData($basePath, $this->LLkey, $GLOBALS['TSFE']->renderCharset, 0);

            if ($this->altLLkey) {
                $tempLOCAL_LANG = $languageFactory->getParsedData($basePath, $this->altLLkey, $GLOBALS['TSFE']->renderCharset, 0);
                $this->LOCAL_LANG = array_merge(is_array($this->LOCAL_LANG) ? $this->LOCAL_LANG : array(), $tempLOCAL_LANG);
                unset($tempLOCAL_LANG);
            }

            // Overlaying labels from TypoScript (including fictitious language keys for non-system languages!):
            $confLL = $this->conf['_LOCAL_LANG.'];
            if (is_array($confLL)) {
                foreach ($confLL as $k => $lA) {
                    if (is_array($lA)) {
                        $k = substr($k, 0, -1);
                        foreach ($lA as $llK => $llV) {
                            if (!is_array($llV)) {
                                // Internal structure is from XLIFF
                                $this->LOCAL_LANG[$k][$llK][0]['target'] = $llV;

                                // For labels coming from the TypoScript (database) the charset is assumed to be "forceCharset" and if that is not set, assumed to be that of the individual system languages
                                $this->LOCAL_LANG_charset[$k][$llK] = $GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset'] ? $GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset'] : $GLOBALS['TSFE']->csConvObj->charSetArray[$k];
                            }
                        }
                    }
                }
            }
        }
        $this->LOCAL_LANG_loaded = 1;
    }

}
