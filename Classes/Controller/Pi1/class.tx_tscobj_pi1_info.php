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
 * Additional information in Web > Page.
 *
 * @category    Plugin
 * @package     TYPO3
 * @subpackage  tx_tscobj
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
class tx_tscobj_pi1_info extends tslib_pibase
{

    /**
     * Returns plugin information.
     *
     * @param array $params
     * @param tx_cms_layout|tx_templavoila_preview_type_list $pObj
     * @return string
     */
    public function getInfo(array $params, $pObj)
    {
        $this->cObj = new stdClass();
        $this->cObj->data = $params['row'];

        // Init flexform configuration of the plugin
        $this->pi_initPIflexForm();

        $tsObjPath = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'object');

        return 'TS: ' . $tsObjPath;
    }

}
