<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Xavier Perseguers <xavier@causal.ch>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

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
class tx_tscobj_pi1_info extends tslib_pibase {

	/**
	 * Returns plugin information.
	 *
	 * @param array $params
	 * @param tx_cms_layout|tx_templavoila_preview_type_list $pObj
	 * @return string
	 */
	public function getInfo(array $params, $pObj) {
		$this->cObj->data = $params['row'];

		// Init flexform configuration of the plugin
		$this->pi_initPIflexForm();

		$tsObjPath = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'object');

		return 'TS: ' . $tsObjPath;
	}

}
