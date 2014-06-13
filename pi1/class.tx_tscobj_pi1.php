<?php
	/***************************************************************
	 * Copyright notice
	 * 
	 * (c) 2004 Jean-David Gadina (macmade@gadlab.net)
	 * All rights reserved
	 * 
	 * This script is part of the TYPO3 project. The TYPO3 project is 
	 * free software; you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation; either version 2 of the License, or
	 * (at your option) any later version.
	 * 
	 * The GNU General Public License can be found at
	 * http://www.gnu.org/copyleft/gpl.html.
	 * 
	 * This script is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 * 
	 * This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/
	
	/** 
	 * Plugin 'TypoScript Object' for the 'tscobj' extension.
	 *
	 * @author		Jean-David Gadina (macmade@gadlab.net)
	 * @version		1.1
	 */
	
	/**
	 * [CLASS/FUNCTION INDEX OF SCRIPT]
	 * 
	 * SECTION:		1 - MAIN
	 *     119:		function main($content,$conf)
	 * 
	 *				TOTAL FUNCTIONS: 1
	 */
	
	// Typo3 FE plugin class
	require_once(PATH_tslib.'class.tslib_pibase.php');
	
	class tx_tscobj_pi1 extends tslib_pibase {
		
		
		
		
		
		/***************************************************************
		 * SECTION 0 - VARIABLES
		 *
		 * Class variables for the plugin.
		 ***************************************************************/
		
		// Same as class name
		var $prefixId = 'tx_tscobj_pi1';
		
		// Path to this script relative to the extension dir
		var $scriptRelPath = 'pi1/class.tx_tscobj_pi1.php';
		
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
		 * @param		$content			The content object
		 * @param		$conf				The TS setup
		 * @return		The content of the plugin
		 */
		function main($content,$conf) {
			
			// Set class confArray TS from the function
			$this->conf = $conf;
			
			// Set default plufin variables
			$this->pi_setPiVarDefaults();
			
			// Load LOCAL_LANG values
			$this->pi_loadLL();
			
			// Init flexform configuration of the plugin
			$this->pi_initPIflexForm();
			
			// Get TS object path
			$tsObjPath = $this->pi_getFFvalue($this->cObj->data['pi_flexform'],'object');
			
			// Check for a non empty value
			if ($tsObjPath) {
				
				// Get complete TS template
				$tmpl = $GLOBALS['TSFE']->tmpl->setup;
				
				// Get TS object hierarchy in template
				$tmplPath = explode('.',$tsObjPath);
				
				// Final TS object storage
				$tsObj = $tmpl;
				
				// Process TS object hierarchy
				for($i = 0; $i < count($tmplPath); $i++) {
					
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
				
				// DEBUG ONLY - Show TS object
				#t3lib_div::debug($cType, 'CONTENT TYPE');
				#t3lib_div::debug($tsObj, 'TS CONFIGURATION');
				
				// Check object and content type
				if ($error) {
					
					// Object not found
					return '<strong>' . $this->pi_getLL('errors.notfound') . '</strong> (' . $tsObjPath . ')';
					
				} elseif (in_array($cType,$this->cTypes)) {
					
					// Use htmlspecialchars to render object?
					$code = ($this->pi_getFFvalue($this->cObj->data['pi_flexform'],'htmlspecialchars')) ? nl2br(htmlspecialchars($this->cObj->cObjGetSingle($cType,$tsObj))) : $this->cObj->cObjGetSingle($cType,$tsObj);
					
				} else {
					
					// Invalid content type
					return '<strong>' . $this->pi_getLL('errors.invalid') . '</strong> (' . $cType . ')';
				}
				// Return object
				return $code;
			}
		}
	}
	
	// XClass inclusion
	if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tscobj/pi1/class.tx_tscobj_pi1.php']) {
		include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tscobj/pi1/class.tx_tscobj_pi1.php']);
	}
?>
