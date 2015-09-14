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

/**
 * Class that adds the wizard icon.
 *
 * @author      Jean-David Gadina <macmade@gadlab.net>
 */
class tx_tscobj_pi1_wizicon
{


    /***************************************************************
     * SECTION 1 - MAIN
     *
     * Wizard items functions.
     ***************************************************************/

    /**
     * Add wizard item to the backend
     *
     * @param        $wizardItems        The wizard items
     * @return        The wizard item
     */
    function proc($wizardItems)
    {
        // Get locallang values
        $LL = $this->includeLocalLang();

        // Wizard item
        $wizardItems['plugins_tx_tscobj_pi1'] = array(

            // Icon
            'icon' => t3lib_extMgm::extRelPath('tscobj') . 'pi1/ce_wiz.gif',

            // Title
            'title' => $GLOBALS['LANG']->getLLL('pi1_title', $LL),

            // Description
            'description' => $GLOBALS['LANG']->getLLL('pi1_plus_wiz_description', $LL),

            // Parameters
            'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=tscobj_pi1',
        );

        // Return items
        return $wizardItems;
    }

    /**
     * Include locallang values
     *
     * @return array The content of the locallang file
     */
    function includeLocalLang()
    {
        $llFile = t3lib_extMgm::extPath('tscobj') . 'Resources/Private/Language/locallang.xlf';

        return $GLOBALS['LANG']->includeLLFile($llFile, false);
    }
}
